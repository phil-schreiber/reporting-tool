{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('medium')}} {{tr('update')}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/medium/create/', 'method': 'post',"enctype":"multipart/form-data") }}

				<label>{{ tr('title') }}</label><br>
				{{ text_field("title", "size": 32,"value":medium.title) }}
				<br><br>                                
                                <label>{{ tr('description') }}</label><br>
				{{ text_area("description","value":medium.description) }}
                                <br><br>
                                <label>{{ tr('reach') }}</label><br>
				{{ text_field("reach", "size": 32, "type":"number", "value":medium.reach) }}
				<br><br>                              
                                <label>{{ tr('type') }}</label><br>
                                {{select('mediumtype',[  '1' : 'print', '0' : 'online'], 'value':medium.mediumtype)}}                                
                                <br><br>
                                <label>Status</label><br>
                                {{select('mediumtype',[  '0' : 'A-Medium', '1' : 'B-Medium', '2':'C-Medium'], 'value': medium.mediumstatus)}}                                
                                <br><br>
                                <label>{{ tr('url') }}</label><br>
				{{ text_field("url", "value":medium.url) }}
                                <br><br>                                
                                <label>{{ tr('logo') }}</label><br>
				{{ file_field("logo","accept":".jpg") }}<br>
                                <img src="{{baseurl}}/{{medium.icon}}">
                                <br><br>
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>

