{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('clippingoverview')}} {{tr('create')}} für {{usergroup.title}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/clippingsoverview/create/', 'method': 'post',"enctype":"multipart/form-data") }}
				                                                            
                                <label>Jahr</label><br>
				{{ text_field("overviewyear", "size": 32) }}
				<br><br>                                                                
                                <label>Monat</label><br>
				{{ text_field("overviewmonth", "size": 32) }}
				<br><br>                                                                
                                {{hidden_field("usergroup","value":usergroup.uid)}}
                                 <label>Datei</label><br>
				{{ file_field("file") }}
                                <br><br>
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>
