@props([
    'title' => 'Baby Shower - Jonas Samuel',
    'description' => 'Acompáñanos a celebrar la llegada de nuestro pequeño en una tarde llena de misterio y ternura. Confirma tu asistencia.',
    'image' => asset('img/fondo.jpeg'),
    'url' => request()->url()
])

<!-- Título y Descripción Estándar -->
<title>{{ $title }}</title>
<meta name="title" content="{{ $title }}">
<meta name="description" content="{{ $description }}">

<!-- Open Graph / Facebook / WhatsApp -->
<meta property="og:type" content="website">
<meta property="og:url" content="{{ $url }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">

<!-- Twitter / X -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="{{ $url }}">
<meta property="twitter:title" content="{{ $title }}">
<meta property="twitter:description" content="{{ $description }}">
<meta property="twitter:image" content="{{ $image }}">
