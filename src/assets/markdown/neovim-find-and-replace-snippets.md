This is a list of nice find and replace regexes you can use in neovim.
The command to start a find and replace in the same file in vim is `:%s`.  
You can append the `g` modifier at the end so it doesn't stop at the first match in a line and the `c` modifier so it asks you before replacing for each occurence.  
I will try to put a link to the place I've found the regex when there is one.

Kebab case to camel case:

```
/-\(.\)/\u\1/
```


Snake case to camel case:

```
/_\(.\)/\u\1/
```