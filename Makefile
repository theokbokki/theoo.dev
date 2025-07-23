# Makefile

SASS = npx sass
ESBUILD = npx esbuild
SRC = src/assets
DEST = public/assets
MANIFEST = public/manifest.json

all: clean build-assets build-scss build-js manifest

clean:
	rm -rf $(DEST)
	mkdir -p $(DEST)
	rm -f $(MANIFEST)

# Copy and hash all assets
build-assets:
	find $(SRC)/img $(SRC)/favicon $(SRC)/markdown -type f | while read file; do \
		name=$$(basename $$file); \
		ext=$${name##*.}; \
		base=$${name%.*}; \
		hash=$$(sha256sum "$$file" | cut -c1-8); \
		cp "$$file" "$(DEST)/$${base}_$${hash}.$${ext}"; \
	done

# Build and hash SCSS
build-scss:
	$(SASS) --no-source-map --style=compressed $(SRC)/scss/app.scss $(DEST)/app.css
	hash=$$(sha256sum $(DEST)/app.css | cut -c1-8); \
	mv $(DEST)/app.css $(DEST)/app_$${hash}.css

# Build and hash JS
build-js:
	$(ESBUILD) --bundle $(SRC)/js/app.js --minify --outfile=$(DEST)/app.js
	hash=$$(sha256sum $(DEST)/app.js | cut -c1-8); \
	mv $(DEST)/app.js $(DEST)/app_$${hash}.js

# Generate manifest
manifest:
	echo "{" > $(MANIFEST)
	ls $(DEST) | while read file; do \
		orig=$$(echo $$file | sed -E 's/_([a-f0-9]{8})//'); \
		echo "  \"$$orig\": \"assets/$$file\","; \
	done | sed '$$s/,$$//' >> $(MANIFEST)
	echo "}" >> $(MANIFEST)

.PHONY: all clean build-assets build-scss build-js manifest
