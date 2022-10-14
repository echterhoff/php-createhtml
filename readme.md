**PHP**CREATE**HTML**

I have added this readme to prevent it from getting lost.
This code has been written by me around 2008/2009 and I have written it for my own pleasure.
I have learned a lot during writing this. Especially gained a deep understanding
of symantics, tokenizing, string processing and regular expressions.
The whole code is written by me and there is not a single line of copied code within this lines.
While casual reviewing this, I realized, I would definitely not be able to rewrite it. Luckily, there is no need,
since this whole thing is senseless in first place these days.

Have fun reading the readme and my code.
I am sorry for my bad english. At least it has not getting worse.

Me in late 2022

## Introduction

This is not more and not less than a very small and straight forward way to create html/sgml strings (objects) from your php script.
As I love to chain objects and make use of the very effective magic call method, I wrote a small class to create sgml elements for further use in php.
If you ever messed around with parsing html code, you probably can imagine several use cases where this class might help you.

This is not a jQuery port or kind of. This is not a templating engine. This is somewhere between raw html-output and a template engine. You might ask your self: What is it good for? - It is quite easy. If you find yourself creating a web application that is more than small but far from big, there is a gap. Using a large framework might be oversized and brings a load of things to care and think of. Putting html strings right into your code will become a shortcome as well as soon as the project grows. Using phpcreatehtml fills this gap. Writing it feels like writing html with php syntax. I have tried to do my best to make creating html from within php as comfortable as possible. Hopefully you will just take a look at the examples or unit tests and start using it without knowing anything. Sounds wired? - I think it is the way programming should work. There are just two things that might help you. The class name is html (even if you dont need it) and it is chainable ->
But the best thing is: create controls and reuse controls.

## Show some love

If you like this project, please support my work! I really appreciate if you share it through your circles.
Download
http://code.echterhoff.it/phpcreatehtml-latest.zip'>http://phpcreatehtml.googlecode.com/hg/misc/phpcreatehtml_download_latest.png' /> http://code.echterhoff.it/phpcreatehtml/version/version.png' /> Why is this download located at echterhoff.it? I have just created an automated testing and build system to ensure you will get always the lastest and perfect working version. (Only backdraw: I can currently not send them back to code.google.com, because the upload interface disappeared some days ago. For this reason, you will get the zip-archive from my site at code.echterhoff.it delivered.)
Short example
This example shows you an easy way to create html code. It also shows you how to use stored references to enhance the objects/output.

##PHP Code

```
$php=create('html',
$head = head(title('My Page')),
    body(
        $header = div('class','header'),
        $body = div('class','main'),
        $footer = div('class','footer')
    )
);

$body->append(h1('This example'));
$body->append(
    h2('is more convenient!'),
    div('class','main')->append(
        p('It uses less confusing technics to code.')
    )
);

echo $php;
```
### HTML Output
```
<html>
  <head>
    <title>My Page</title>
  </head>
  <body>
    <div class="header"></div>
    <div class="main">
      <h1>This example</h1>
      <h2>is more convenient!</h2>
      <div class="main">
        <p>It uses less confusing technics to code.</p>
      </div>
    </div>
    <div class="footer"></div>
  </body>
</html>
```

### PHP Code

```
ctrl('mypage')->append(
create('html')->
    appendDimension(
      head(title('#title')),
      body(
        div('class','main')->
          appendDimension(
            div('class','#entryid')->append(
              h3('#headline'),p('#content')
            )
          )
      )
    )
);

$php = ctrl('mypage')
    ->title('My Page')
    ->entryid('entry1')
    ->headline('This is a control example')
    ->content('Controls are easy to setup and reuse.');

echo $php;
```

### HTML Output
```
<html>
  <head>
    <title>My Page</title>
  </head>
  <body>
    <div class="main">
      <div class="entry1">
        <h3>This is a control example</h3>
        <p>Controls are easy to setup and reuse.</p>
      </div>
    </div>
  </body>
</html>
```

### PHP Code
```
$php = ctrl('mypage')->explode(
    array(
        array(
          'title'=>'My Page',
          array('entryid'=>'entry1','headline'=>'Output1',
                'content'=>'This is the first entry'),
          array('entryid'=>'entry2','headline'=>'Output two',
                'content'=>'This is the second entry'),
          array('entryid'=>'entry3','headline'=>'Output #three',
                'content'=>'This is the last entry'),
        ),
    )
);

echo $php;
```

### HTML Output
```
<html>
  <head>
    <title>My Page</title>
  </head>
  <body>
    <div class="main">
      <div class="entry1">
        <h3>Output1</h3>
        <p>This is the first entry</p>
      </div>
      <div class="entry2">
        <h3>Output two</h3>
        <p>This is the second entry</p>
      </div>
      <div class="entry3">
        <h3>Output #three</h3>
        <p>This is the last entry</p>
      </div>
    </div>
  </body>
</html>
```

This example only showcases some of the different write styles you can choose from. Please take a look at my example page to find some cleaner more self explaining examples.

```
$php=create('html') // <- Yeah, this realy works! ;-)
->append(
    $head = html::tag('head')->append(
        html("<title>")->text('My Page')
    ),
    body(
        $header = div()->class('header'),
        $body = div('class','main'),
        $footer = html::div()->{'class="footer"'}()
    )
);

h1('This example')->appendTo($body);

$body->append(
    h2('might be confusing!'),div('class','main',p('It uses several different technics to code.','class','mytext'))
);

echo $php;
```
Output:
```
<html>
  <head>
    <title>My Page</title>
  </head>
  <body>
    <div class="header"></div>
    <div class="main">
      <h1>This example</h1>
      <h2>might be confusing!</h2>
      <div class="main">
        <p class="mytext">It uses several different technics to code.</p>
      </div>
    </div>
    <div class="footer"></div>
  </body>
</html>
```

## Roadmap
~~Before I'll start introducing new features, my first goal is to archive a rock solid, stable and fast base class. Everything else will be build on top of this base.
Fixes
Commented code :-P
Object cleanup. Cause currently the multidimensional repeating extends the object a little messy...
Find bugs and remove them. Appreciate any help on finding bugs.
Upcoming features
Export controls to a text file. A kind of precompiled control library, that is easy to maintain
Namespace support for this class
Namespace support for html/xml creation
Events (Done, rest is to be done), that are able to be stored into a text export. (About 100 lines of commented code are already in to create serializable lambda functions)
More buildin export functions beside toString() and toArray() like toJson()
Better interfaces to extend the functionality to your needs.
"Assisted mode" that learns from your use and detects misspelled tags, attributes, etc...
Convert mode, that returns php-syntax from given html.
a lot more...
Live enviroment
Live examples
Live unit test
Unit test results~~