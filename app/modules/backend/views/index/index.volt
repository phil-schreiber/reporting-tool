{% include 'partials/flash-messages.volt' %}
<div class="container">
	{{ content() }}
<h1>{{tr('loginTitle')}}</h1>


<div class="loginForm">
  <form action="{{ form.getAction() }}" method="POST">
   <label for="username">Email: </label><br>
    {{form.render('username')}}<br/><br>
    

    <label for="password">Password: </label><br>
    {{form.render('password')}}<br><br>
    {{form.render('redirect')}}

    {{form.render('login')}}
  </form>
</div>
</div>