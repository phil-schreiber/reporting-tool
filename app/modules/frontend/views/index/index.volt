<div id="header"><img src="{{baseurl}}img/header_df.jpg" width="2604" height="541" alt="" class="img-responsive"/> </div>
<div id="navigation">
    <nav class="navbar denkfabrikscheme no-border no-active-arrow no-open-arrow dropdown-onhover" id="main_navbar" role="navigation"></nav>
</div>
{% include 'partials/flash-messages.volt' %}

<div class="container">
	{{ content() }}
<h1>{{tr('loginTitle')}}</h1>


<div class="loginForm">
  <form action="{{ form.getAction() }}" method="POST">
   <label for="username">Nutzername: </label><br>
    {{form.render('username')}}<br/><br>
    

    <label for="password">Password: </label><br>
    {{form.render('password')}}<br><br>
    {{form.render('redirect')}}

    {{form.render('login')}}
  </form>
</div>
</div>