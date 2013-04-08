sendmail
========

Helper class for PHP for sending Anti-Spam emails using "mail" function.

Class is named Send, but you can change it to what ever you need it to be instead.

Methods are chained and you can easily send an E-Mail:

    Send::mail()->
      to('some@one.com')->
      from('me@somewhere.com')->
      fromName('Some One')->
      subject('Hi there.')->
      message('How are thy?')->send();

You get the idea already :)

Code is very readable so you will get to know what it does.

