{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>{{tr('clippingoverview')}} {{tr('create')}} für {{usergroup.title}}</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/mediacontacts/create/', 'method': 'post') }}
				                                                            
                            <label>Medium</label><br>
                            {{  select('medium',medium,"using":['uid','title']) }}
                            <br><br>
                            <label>Titel</label><br>
                            {{ text_field("title", "size": 32) }}
                            <br><br>                                                                
                            <label>Thema</label><br>
                            {{ text_area("description", "size": 32) }}
                            <br><br>                 
                            <label>Beginn</label><br>
                            {{ text_field("starttime", "size": 32, "class":"datetimepicker") }}
                            <br><br>  
                            <label>Ende</label><br>
                            {{ text_field("endtime", "size": 32, "class":"datetimepicker") }}
                            <br><br>  
                            {{hidden_field("usergroup","value":usergroup.uid)}}

                            <br><br>
                             {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>
