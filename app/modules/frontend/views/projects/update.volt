{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
    <div class="col-xs-12">
    	<h1>{{ptypesarr[project.projecttype]}}: {{project.title}}</h1>
        <label>Titel:</label>
        <p>{{project.title}}</p>
        <label>Beschreibung:</label>
        <p>{{project.description}}</p>
        <label>Beginn:</label>
        <p>{{date('d/m/Y',project.starttime)}}</p>
        <label>Aufwand:</label>
        <p>{{project.estcost}} h</p>
        <label>Status</label>
        <p>{{projectstate[project.status]}}</p>
        <label>Deadline:</label>
        <p>
            {% if project.deadline == 0 %}
            keine
            {% else %}
            {{date('d/m/Y',project.starttime)}}
            {% endif %}
        </p>
        
        {{ hidden_field("projectuid","value": project.uid) }}
    </div>
    <div class="col-xs-12">
        <h1>{{tr('clippings')}}</h1>
        <table id="clippings" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>{{tr('publicationdate')}}</th>
		<th>{{tr('medium')}}</th>
                <th>{{tr('title')}}</th>
                <th>{{tr('clippingtype')}}</th>
                <th>{{tr('file')}}</th>		
                <th>{{tr('url')}}</th>
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>{{tr('publicationdate')}}</th>
		<th>{{tr('medium')}}</th>
                <th>{{tr('title')}}</th>
                <th>{{tr('clippingtype')}}</th>                
		<th>{{tr('file')}}</th>		
                <th>{{tr('url')}}</th>
            </tr>
        </tfoot>
    </table>
    </div>
</div>
{% endif %}
