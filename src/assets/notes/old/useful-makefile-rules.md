This page is a list of snippets listing some Makefile rules I like to use.
These commands are example written in the way I use them, you would need to add the correct variables and update a couple other things.

<a href="https://learnxinyminutes.com/make/" target="_blank">This website</a> is a great resource to learn how make works quickly.

---

Build and hash CSS

```
# Build and hash CSS
build-css:
	npx esbuild $(SRC)/css/app.css --outfile=$(DEST)/app.css --bundle --minify
	hash=$$(sha256sum $(DEST)/app.css | cut -c1-8); \
	mv $(DEST)/app.css $(DEST)/app_$${hash}.css
```

---


Build and hash JS

```
# Build and hash JS
build-js:
	$(ESBUILD) --bundle $(SRC)/js/app.js --minify --outfile=$(DEST)/app.js
	hash=$$(sha256sum $(DEST)/app.js | cut -c1-8); \
	mv $(DEST)/app.js $(DEST)/app_$${hash}.js
```

---

Build and hash SCSS

```
# Build and hash SCSS
build-scss:
	$(SASS) --no-source-map --style=compressed $(SRC)/scss/app.scss $(DEST)/app.css
	hash=$$(sha256sum $(DEST)/app.css | cut -c1-8); \
	mv $(DEST)/app.css $(DEST)/app_$${hash}.css
```

---

Create a manifset.json file

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

---

Copy and hash files

```
# Copy and hash files
build-assets:
	find $(SRC)/img $(SRC)/favicon -type f | while read file; do \
		name=$$(basename $$file); \
		ext=$${name##*.}; \
		base=$${name%.*}; \
		hash=$$(sha256sum "$$file" | cut -c1-8); \
		cp "$$file" "$(DEST)/$${base}_$${hash}.$${ext}"; \
	done
```