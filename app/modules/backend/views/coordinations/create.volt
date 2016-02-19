{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('clipping')}} {{tr('create')}} für {{usergroup.title}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/coordinations/create/', 'method': 'post',"enctype":"multipart/form-data") }}

				<label>{{ tr('title') }}</label><br>
				{{ text_field("title", "size": 32) }}
				<br><br>
                                
                                <label>{{ tr('comments') }}</label><br>
				{{ text_area("comments") }}
                                <br><br>
                                <label>Datum</label><br>
				{{ text_field("tstamp", "size": 32, "class":"datepicker") }}
				<br><br>                                                                
                                <label>{{ tr('project') }}</label><br>
				{{select('projects[]',projects,"using":['uid','title'],"multiple":"multiple")}}
                                <br><br>                                                                
                                
                                {{hidden_field("usergroup","value":usergroup.uid)}}
                                
                                
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>
