<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body>
    <a href="{{route('contacts.index')}}">All Contacts</a>
    <a href="{{route('contacts.create')}}">Add Contacts</a>
    <a href="{{route('contacts.show', 1)}}">Show a contact</a>
    </body>
</html>
