{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('clippingoverview')}} {{tr('create')}} für {{usergroup.title}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/clippingsoverview/update/'~clipping.uid, 'method': 'post',"enctype":"multipart/form-data") }}
				                                                            
                                <label>Jahr</label><br>
				{{ text_field("overviewyear", "size": 32,"value":clipping.overviewyear) }}
				<br><br>                                                                
                                <label>Monat</label><br>
				{{ text_field("overviewmonth", "size": 32,"value":clipping.overviewmonth) }}
				<br><br>                                                                
                                {{hidden_field("usergroup","value":usergroup.uid)}}
                                 <label>Datei</label><br>
                                 {{ file_field("file") }}<br>
                                <a href="{{baseurl}}{{clipping.filelink}}">Download</a>
                                <br><br>
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>