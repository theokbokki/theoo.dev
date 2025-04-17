Hey there, I'm Théoo

Welcome to my place on the internet! It's where I keep images, shaders, notes, recipes, links and everything else I want to remember or see.  
During the day I build websites at <a href="https://whitecube.be" target="_blank">Whitecube</a>, a small but mighty company in Liège, Belgium. And when I come home, I try to learn the art of shader-making—I'm a big fan of pretty pixels moving on my screen.

::no-indent

You can <a href="mailto:hello@theoo.dev">email me at hello@theoo.dev</a> if you want to talk :))

---

This website's goal is to share the things I like with the world.  
As such, I decided to keep things pretty simple. It's only some black text on a white background at the end of the day.  
The advantage of this approach is that it allows the content to be the main character, not the website itself. This is important to me as I view this place as a way to showcase my work—be it writing, designs, code, shaders, what have you—in a way where visitors can fully enjoy it without being distracted by nice but unnecessary flourishes that are there only to look good.

That said, I've still put real effort in the choice of the font, font-sizes, colors and spacing, trying to give a pleasant reading experience to my visitors.  
The type is set in <a href="https://edwardtufte.github.io/et-book/" target="_blank">ET Book</a>, an open source font that, to me, feels delightful to read.  
Since this website is mostly gonna be composed of text content, I decided that reading through my ramblings should feel as good as reading through an actual book and I hope I achieved that.  
Stylistically, I've decided to use titles sparingly, replacing them by dinkuses (✽) where possible. I got this idea from <a href="https://manuelmoreale.com" target="_blank">Manuel Moreale's website</a>. I've also made the choice to indent every new paragraph by 2 characters as I felt it made the text more book-like.  
I've kept the font size of the text at 16px because I think it worked well with the font. Plus a benefit of keeping the site simple is that you can always zoom in or out to adapt it to your needs without running into layout issues.  
The line height is set at a comfortable 150% of the font size, with spacing between the paragraphs set at 200%. This is more than what you would typically see in a book, but I feel that writing for the screen asks for more spacing in order to keep things breathable.

For the colorscheme, I opted to keep things pretty simple.
All the colors come from tailwindcss' color palettes, I tend to always use them in my websites because they work well and are easy to use.
The text is dark grey (#57534D) rather than plain black as to keep it comfortable for the reader but still contrasting enough to be easily readable and accessible.  
Apart from that, a light orange (#FFEDD4) is used as the selection color to replace the default blue of which I'm no fan. And a light grey (#D6D3D1) is used for the dinkuses so that they don't distract from the text.

---

On the technical side, this website runs on <a href="https://laravel.com" target="_blank">Laravel</a>—a great php framework.  
I chose Laravel because this is the tool I'm most familiar with as I use it every day at work and also because the tooling and the ecosystem they offer is vast, rich and full of great people.  
Also, deploying it to the world is really easy.

Most pages (like this one) are simple markdown files that I render using Laravel's built-in markdown parser. The syntax highlighting is using <a href="https://github.com/phikiphp/phiki" target="_blank">Phiki</a> under the hood.  
As for the collection pages you can find in the navigation, they are regular <a href="https://laravel.com/docs/12.x/blade#main-content" target="_blank">Blade templates</a>.  
For styling the pages, I decided to use <a href="https://sass-lang.com/" target="_blank">Sass</a> because it allows me to use features that are now in modern day CSS (like nesting) without being afraid of support. I tried my best to use css properties that are widely supported, or at least ones that degrade gracefully.  
If you see something that is broken in your browser, please tell me about it so I can fix it :))  
On the JavaScript side, I tried to keep things as minimal as possible, using it only in pages where I didn't have the choice (Like the shaders page for example). I made sure that you are only loading this website's Javascript when you are on a page that requires it and not all the time.  
The advantage of this setup is that my pages load quickly since they are super light, in turn giving a better experience to my user.

The website is hosted by <a href="https://www.infomaniak.com/en" target="_blank">Infomaniak</a>. I like them because they have a real commitment towards <a href="https://www.infomaniak.com/fr/ecologie" target="_blanks">keeping our planet alive</a> and this is a topic that I deeply care about.

---

Here's a list of the things that inspired me when building this website:
- <a href="https://manuelmoreale.com" target="_blank">Manuel Moreale's website</a>
- The book <a href="https://www.amazon.co.uk/Sustainable-Web-Design-Tom-Greenwood/dp/1068759402/" target="_blank">Sustainable Web Design</a> by Tom Greenwood
- The <a href="https://edwardtufte.github.io/et-book/" target="_blank">ET Book font's website</a>
- <a href="https://slrncl.com/" target="_blank">Nicolas Solerieu's website</a>
- The "early web" style of <a href="https://melonking.net" target="_blank">MelonKing's website</a>
- <a href="https://stackingthebricks.com/how-blogs-broke-the-web/" target="_blank">This article</a> by Amy Hoy
- <a href="https://ambedg.ar" target="_blank">Edgar Ambartsoumian's website</a>
- <a href="https://paco.me" target="_blank">Paco Coursey's website</a>
