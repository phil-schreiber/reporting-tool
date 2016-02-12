{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('projecttypes')}} {{tr('create')}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/medium/create/', 'method': 'post',"enctype":"multipart/form-data") }}

				<label>{{ tr('title') }}</label><br>
				{{ text_field("title", "size": 32) }}
				<br><br>                                
                                <label>{{ tr('description') }}</label><br>
				{{ text_area("description") }}
                                <br><br>
                                <label>{{ tr('reach') }}</label><br>
				{{ text_field("reach", "size": 32, "type":"number") }}
				<br><br>                              
                                <label>{{ tr('type') }}</label><br>
                                {{select('mediumtype',[  '1' : 'print', '0' : 'online'], 'value':0)}}                                
                                <br><br>
                                <label>{{ tr('url') }}</label><br>
				{{ text_field("url") }}
                                <br><br>
                                <label>{{ tr('logo') }}</label><br>
				{{ file_field("logo","accept":".jpg") }}
                                <br><br>
				 {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>
