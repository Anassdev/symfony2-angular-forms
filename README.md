symfony2-angular-forms
======================

Trying out Symfony2 forms with Angular forms

The purpose of this repository is to combine Symfony (2.3) forms and AngularJs (1.2) forms validition to create a nice user experience.


Why use Symfony forms?
----------------------
Symfony forms are easy to deal with. Creating forms, binding models on, validating them, extending them and outputting them is al fairly easy. [Symfony 2.3 Forms reference](http://symfony.com/doc/2.3/book/forms.html)


Why use AngularJs form validation?
----------------------------------
AngularJs form (and field) directives offer the ability to easily do client side validation and checks for changes in the fields and form. [Angular 1.2 Form directive reference](http://docs.angularjs.org/guide/forms)


So what are we trying to do here?
----------------------------------
The art of combining those two is not simple. We don't want to duplicate all the validation rules, manually add Angular directives on the form elements (ngModel, ngRequired, ...). We don't want to have a page reload when the form submits and we do want to get the Symfony validation errors back.

In this repository I set up a simple example doing all this.

I'll write a blog post on how I achieved this later.


Disclaimer
----------
I'm not using best practices in the backend here: saving/reading contacts happens in the controller, no real "domain", public properties, no test. 

In the front-end it's a bit better, I do have controllers and services, but still no tests ...
