{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">
{%- if session.get('auth') -%}
	<div class='ceElement medium'>
	<h1>{{tr('addressListLabel')}}: {{distributor.title}}</h1>
	<div class='listelementContainer'>
		{{ form(language~'/distributors/update/'~distributor.uid, 'method': 'post') }}


			<label>{{ tr('distributorTitleLabel') }}</label><br>
			{{text_field('title',"value":distributor.title)}}	
			<br><br>	
			<label>{{ tr('addressfolders') }}</label><br>
			<select name="addressfolders[]" multiple>
				{% for addressfolder IN addressfolders %}
				<option value="{{addressfolder.uid}}" {% if addressfolder.uid in distributorFoldersArray%} selected {% endif %} >{{addressfolder.title}} | {{addressfolder.countAddresses()}}</option>
				{% endfor %}
			</select>

			<br><br>
			<label>{{ tr('segmentobjectsTitle') }}</label><br>
			<select name="segmentobjects[]" multiple>
				{% for segmentobject IN segmentobjects %}
				<option value="{{segmentobject.uid}}" {% if segmentobject.uid in distributorSegmentsArray  %} selected {% endif %}>{{segmentobject.title}} | {{segmentobject.countAddresses()}}</option>
				{% endfor %}
			</select>


			<br><br>

			{{ hidden_field('uid',"value":distributor.uid) }}
			{{ submit_button(tr('ok'),'id':'uploadAndShowMap') }}

		</form>
	</div>
	</div>
{%- endif -%}

</div>