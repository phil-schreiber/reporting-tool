{{ content() }}
{%- if session.get('auth') -%}
<div class="container">
    <div class="col-xs-12">
    	<h1>{{ptypesarr[project.projecttype]}}: {{project.title}}</h1>
        <table>
            <tr>
                <td>Titel:</td><td>{{project.title}}</td>
            </tr>
            <tr>
                <td>Beschreibung:</td><td>{{project.description}}</td>
             </tr>
             <tr>
                <td>Thema:</td><td>{{project.topic}}</td>
             </tr>
             <tr>
                <td>Beginn:</td><td>{{date('d/m/Y',project.starttime)}}</td>
            </tr>
            <tr>
                <td>Status:</td><td>{{projectstates[projectstate.statetype]}} / {{projectstate.description}}</td>
            </tr>
            <tr>
                <td>Deadline:</td><td>{% if project.deadline == 0 %}
            keine
            {% else %}
            {{date('d/m/Y',project.starttime)}}
            {% endif %}</td>
            </tr>
        </table>
        
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
                
            </tr>
        </thead>
 
        <tfoot>
            <tr>
                <th>{{tr('publicationdate')}}</th>
		<th>{{tr('medium')}}</th>
                <th>{{tr('title')}}</th>
                <th>{{tr('clippingtype')}}</th>                
		<th>{{tr('file')}}</th>		
                
            </tr>
        </tfoot>
    </table>
    </div>
</div>
{% endif %}
