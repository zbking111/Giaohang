<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="shortcut icon" href="img/fav.png">
<meta name="author" content="colorlib">

<meta property="og:title" content="{{ empty(@$arrMeta['title']) ? @$metaDefault->setting->meta_title : @$arrMeta['title'] }}" />
<meta property="og:url" content="{{ url()->full() }}" />
<meta property="og:image" content="{{ url('') }}{{ empty(@$arrMeta['meta_image']) ? '' : @$arrMeta['meta_image'] }}"/>
<meta property="og:description" content="{{ empty(@$arrMeta['meta_description']) ? @$metaDefault->setting->meta_description : @$arrMeta['meta_description'] }}" />
<meta property="fb:app_id" content=""/>

<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="{{ empty(@$arrMeta['meta_content']) ? '' : @$arrMeta['meta_content'] }}">
<meta itemprop="description" content="{{ empty(@$arrMeta['meta_description']) ? @$metaDefault->setting->meta_description : @$arrMeta['meta_description'] }}">
<meta itemprop="image" content="{{ url('') }}{{ empty(@$arrMeta['meta_image']) ? '' : @$arrMeta['meta_image'] }}">

<!-- meta -->
<meta name="description" content="{{ empty(@$arrMeta['meta_description']) ? @$metaDefault->setting->meta_description : @$arrMeta['meta_description'] }}">
<meta name="keywords" content="{{ empty(@$arrMeta['meta_keyword']) ? @$metaDefault->setting->meta_keyword : @$arrMeta['meta_keyword'] }}">
<meta name="news_keywords" content="{{ empty(@$arrMeta['meta_content']) ? @$metaDefault->setting->meta_keyword : @$arrMeta['meta_content'] }}" />
<meta name="google-site-verification" content="" />

<meta name="rating" content="general"/>
<meta name="robots" content="all"/>
<meta name="robots" content="index, follow"/>
<meta name="revisit-after" content="1 days"/>
<!-- Site Title -->

<title> {{ @$arrMeta['title'] ?? @$metaDefault->setting->title  }} </title>