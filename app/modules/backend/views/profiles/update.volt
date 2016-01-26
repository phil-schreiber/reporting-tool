{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="ceElement large">
<h1>{{tr('profile')}}</h1>
<div class="dataTables_wrapper">
<table  class="display dataTable">
	
		<tr>
			
			
			<td>
				<table>
					<thead>
						<tr><th colspan="6"><strong>{{profile.title}}:</strong></th></tr>
						<tr>
							<th>{{tr('resources')}}</th>
							<th>{{tr('index')}}</th>
							<th>{{tr('create')}}</th>
							<th>{{tr('retrieve')}}</th>
							<th>{{tr('update')}}</th>
							<th>{{tr('delete')}}</th>
						</tr>
					</thead>
					<tbody>
						{% for index,resource in resources %}
						<tr class='{% if index is even %}even{% else %}odd{%endif%}'>	
							<td><strong>{{resource.title}}: </strong></td>
							<td><input type="checkbox" value="{{profile.uid~'_'~resource.uid~'_'~1}}" {% if permissions[profile.uid][resource.uid]['index'] is defined %} checked="checked"{% endif %}></td>
							<td><input type="checkbox" value="{{profile.uid~'_'~resource.uid~'_'~2}}" {% if permissions[profile.uid][resource.uid]['create'] is defined %} checked="checked"{% endif %}></td>
							<td><input type="checkbox" value="{{profile.uid~'_'~resource.uid~'_'~3}}" {% if permissions[profile.uid][resource.uid]['retrieve'] is defined %} checked="checked"{% endif %}></td>
							<td><input type="checkbox" value="{{profile.uid~'_'~resource.uid~'_'~4}}" {% if permissions[profile.uid][resource.uid]['update'] is defined %} checked="checked"{% endif %}></td>
							<td><input type="checkbox" value="{{profile.uid~'_'~resource.uid~'_'~5}}" {% if permissions[profile.uid][resource.uid]['delete'] is defined %} checked="checked"{% endif %}></td>
						</tr>
						{% endfor %}
					</tbody>				
				</table>
			</td>
			
		</tr>
	
	<tbody>
	
	</tbody>
</table>
</div>