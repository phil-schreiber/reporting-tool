<div id="header" style="position:relative;">
    <div class="container" style="position:relative;">
    <h1 style="position:absolute;font-size:4em;color:#50504F;font-weight:400;left:3vw;top:2vh;">PR<span style="color:#E07E26">Reporting</span>Portal</h1>
    </div>
    <img src="{{baseurl}}img/header_df.jpg" width="2604" height="541" alt="" class="img-responsive"  /> 
</div>
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