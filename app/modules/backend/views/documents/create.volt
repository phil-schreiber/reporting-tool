{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('documents')}} {{tr('create')}} für {{usergroup.title}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/documents/create/', 'method': 'post',"enctype":"multipart/form-data") }}

				<label>{{ tr('title') }}</label><br>
				{{ text_field("title", "size": 32) }}
				<br><br>
                                
                                <label>{{ tr('description') }}</label><br>
				{{ text_area("description") }}
                                <br><br>
                                <label>Veröffentlichungsdatum</label><br>
				{{ text_field("tstamp", "size": 32, "class":"datepicker") }}
				<br><br>                                                                
                                <label>{{ tr('project') }}</label><br>
				{{select('pid',projects,"using":['uid','title'])}}
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
