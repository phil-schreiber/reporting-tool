{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
	{%- if session.get('auth') -%}
	<div class="ceElement medium">
		<h1>Medienkontakt bearbeiten</h1>
		<div class="listelementContainer">

			
			{{ form('backend/'~language~'/mediacontacts/update/'~mediacontact.uid, 'method': 'post') }}
				                                                            
                            <label>Medium</label><br>
                            {{  select('medium',medium,"using":['uid','title'],"value":mediacontact.medium) }}
                            <br><br>
                            <label>Titel</label><br>
                            {{ text_field("title", "size": 32,"value":mediacontact.title) }}
                            <br><br>                                                                
                            <label>Thema</label><br>
                            {{ text_area("description", "size": 32,"value":mediacontact.description) }}
                            <br><br>                 
                            <label>Beginn</label><br>
                            {{ text_field("starttime", "size": 32, "class":"datetimepicker","value":date('d.m.Y H:i',mediacontact.starttime)) }}
                            <br><br>  
                            <label>Ende</label><br>
                            {{ text_field("endtime", "size": 32, "class":"datetimepicker","value":date('d.m.Y H:i',mediacontact.endtime)) }}
                            <br><br>  
                            {{hidden_field("usergroup","value":usergroup.uid)}}

                            <br><br>
                             {{ submit_button(tr('ok')) }}

			</form>
		</div>
	</div>
{%- endif -%}

</div>
