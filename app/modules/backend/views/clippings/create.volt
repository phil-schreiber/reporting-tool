{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('clipping')}} {{tr('create')}} für {{usergroup.title}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/clippings/create/', 'method': 'post',"enctype":"multipart/form-data") }}

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
				{{select('project',projects,"using":['uid','title'])}}
                                <br><br>                                                                
                                <label>{{ tr('medium') }}</label><br>
				{{select('medium',medium,"using":['uid','title'])}}
                                <br><br>
                                <label>{{ tr('type') }}</label><br>
                                {{select('clippingtype',[ '2':'newsletter', '1' : 'print', '0' : 'online'], 'value':0)}}                                
                                <br><br>
                                <label>{{ tr('url') }}</label><br>
				{{ text_field("url", "size": 32) }}
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
