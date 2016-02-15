{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('clipping')}} {{tr('create')}} für {{usergroup.title}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/clippings/update/'~clipping.uid, 'method': 'post',"enctype":"multipart/form-data") }}

				<label>{{ tr('title') }}</label><br>
				{{ text_field("title", "size": 32, "value":clipping.title) }}
				<br><br>
                                
                                <label>{{ tr('description') }}</label><br>
				{{ text_area("description","value":clipping.description) }}
                                <br><br>
                                <label>Veröffentlichungsdatum</label><br>
				{{ text_field("tstamp", "size": 32, "class":"datepicker","value":date('d.m.Y',clipping.tstamp)) }}
				<br><br>                                                                
                                <label>{{ tr('project') }}</label><br>
				{{select('project',projects,"using":['uid','title'], "value":clipping.pid)}}
                                <br><br>                                                                
                                <label>{{ tr('medium') }}</label><br>
				{{select('medium',medium,"using":['uid','title'],"value":clipping.mediumuid)}}
                                <br><br>
                                <label>{{ tr('type') }}</label><br>
                                {{select('clippingtype',[  '1' : 'print', '0' : 'online'], 'value':clipping.clippingtype)}}                                
                                <br><br>
                                <label>{{ tr('url') }}</label><br>
				{{ text_field("url", "size": 32,"value":clipping.url) }}
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

