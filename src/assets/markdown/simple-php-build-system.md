In <a href="/notes.php?name=making-a-simple-website-with-plain-php">a previous note</a>, I tried to make a website using only plain PHP and CSS. As a result, I came to the conclusion that it was very nice but it would be better to have a way to build the assets.  
So I thought about it for a while and explored different possibilities, In the end I went with a simple system consisting of 1 npm package, a Makefile and a tiny PHP function.

The one npm package we need is <a href="https://esbuild.github.io" target="_blank">esbuild</a>, we are going to use it to bundle our CSS. The rest is all going to be made using basic unix tools, this isn't really windows friendly, but I'm mainly making this website for myself and I don't own a computer running windows.

Here's an outline of the general concept before we dive into it deeper.  
What we are going to do is create a makefile with a couple of rules. We are going to have a rule for bundling our CSS all in one hashed file, a rule to hash and move our assets to a public directory (images, and favicons in my case), and one to generate a manifest.json file that our PHP will be able to read from.

--- 

The first thing we can do is define some variables to use later
```
ESBUILD = npx esbuild
SRC = src/assets
DEST = public/assets
MANIFEST = public/manifest.json
```

Then we can define our first rule, the one to bundle CSS
```
# Build and hash CSS
build-css:
	npx esbuild $(SRC)/css/app.css --outfile=$(DEST)/app.css --bundle --minify
	hash=$$(sha256sum $(DEST)/app.css | cut -c1-8); \
	mv $(DEST)/app.css $(DEST)/app_$${hash}.css
```

What this rule does is first, bundle and minify the CSS file using esbuild. After that, it creates a hash using <a href="https://linux.die.net/man/1/sha256sum" target="_blank">sha256sum</a> and pipes it to the <a href="https://en.wikipedia.org/wiki/Cut_(Unix)">cut</a> command to extract the first 8 characters.  
We then append the cut hash to the filename and move it its new place.

--- 

The second rule is the one for moving the assets in the correct place.
```
# Copy and hash all assets
build-assets:
	find $(SRC)/img $(SRC)/favicon -type f | while read file; do \
		name=$$(basename $$file); \
		ext=$${name##*.}; \
		base=$${name%.*}; \
		hash=$$(sha256sum "$$file" | cut -c1-8); \
		cp "$$file" "$(DEST)/$${base}_$${hash}.$${ext}"; \
	done
```

Here, we use <a href="https://man7.org/linux/man-pages/man1/find.1.html" target="_blank">find</a> to get all the files in the specified directories. Then we pipe them into a bash while loop that takes the piped file path as an argument (using `read file`) and does the following for each file path:
1. Extract the filename using the <a href="https://ss64.com/bash/basename.html" target="_blank">basename</a> function
2. Extract the extension using `##*.` to remove the longest match until the last dot of the filename from the start of the string.
3. We do the opposite by using `%.*` which removes the shortest match until the first dot in the filename from the back of the string.
4. We create a hash in the same way as before for the CSS
5. We copy the file to its new destination while appending the hash to its name.

--- 

Lastly we need a rule to generate the manifest.
```
# Generate manifest
manifest:
	echo "{" > $(MANIFEST)
	ls $(DEST) | while read file; do \
		orig=$$(echo $$file | sed -E 's/_([a-f0-9]{8})//'); \
		echo "  \"$$orig\": \"assets/$$file\","; \
	done | sed '$$s/,$$//' >> $(MANIFEST)
	echo "}" >> $(MANIFEST)
```

This rule is pretty simple, we pipe the result of `ls` on the `public/assets` directory into a bash while loop and for each line of the `ls` (aka each file), we get back the original filename using <a href="https://www.shellunix.com/sed.html" target="_blank">sed</a>.  
The regex applied here is going to replace a string of 8 characters that are either a to f or 0 to 9 (`[a-f0-9]`, which is the default character set for `sha256sum`) that come after a underscore. This leaves us with only the filename without the hash.  
We then echo both original and hashed filenames as key and value of the json file.
The last important thing this does is another sed command on the last line of the file (`$s` means last line) in order to remove the trailing comma which isn't valid in json.

--- 

For good measure, we can also add a `clean` rule, which is conventional in Makefiles and serves as a way to reset everything to be able to run our other rules on a clean slate.  
Nothing to explain here really, we are simply deleting the built files.

```
clean:
	rm -rf $(DEST)
	mkdir -p $(DEST)
	rm -f $(MANIFEST)
```

And with all that setup, we can finally create our default `all` rule that will be invoked when we run the `make` command alone.

```
all: clean build-assets build-css manifest
```

The last cool thing we can do is create a PHP function to decode the `manifest.json` and serve the correct assets to the front end like so:
```
function asset(string $name): string
{
    static $manifest = null;

    if ($manifest === null) {
        $content = file_get_contents(__DIR__.'/../public/manifest.json');
        $manifest = json_decode($content, true);
    }

    if (isset($manifest[$name])) {
        return '/'.$manifest[$name];
    }

    return '/assets/'.$name;
}
```

--- 

I'm really pleased with how this turned out. I think I was able to come up with a pretty simple solution that doesn't require a lot of stuff that isn't already on my computer (Basically only esbuild).  
I know that this approach has its issues, like for example the way we create the `manifest.json`, it's pretty error prone depending on the filenames and using a tool like <a href="https://jqlang.org/" target="_blank">jq</a> would have been smart. But since I have total control over everything, this is really a non-issue.  
I'm happy I got to learn make and also a fair bit of bash in the process, unix tools are really a fascinating subject that I think everyone that likes to code should explore a little bit.

What do you think of this setup? Do you have experience doing something similar or see something I'm doing very wrong? Please <a href="mailto:theoo.dev">let me know</a>, I would love to chat about nerdy stuff like this :))
