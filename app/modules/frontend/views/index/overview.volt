{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">    
 <div class="col-xs-12">
    	<h1>Projektübersicht {{date('Y')}}</h1>        
        
        
            <table class="display dataTable">
                <thead>
                    <tr>
                        <th>{{tr('projecttype')}}</th>
                        <th>erbracht</th>
                        <th>plan</th>
                        <th>Themen</th>
                    </tr>
                </thead>
                <tbody>
                {% for index,spec in specscount %}
                <tr {% if index %2 ==0 %}class="even"{% else %} class="odd"{% endif %}>
                    <td>{{spec["title"]}}</td>
                    <td>
                        {%if arrayKeyExists(index,projectcount) %}
                        {{projectcount[index]}}
                        {% else %}
                        0
                        {% endif %}
                    </td>
                    <td>{{spec["amount"]}}</td>
                    <td>
                        <ul>
                            {% if isset(projects[index]) %}
                            {% for project in projects[index] %}
                            <li><a href="{{host}}{{baseurl}}{{language}}/projects/update/{{project.uid}}">{{project.title}}</a></li>
                            {% endfor %}
                            {% endif %}
                        </ul>
                    </td>
                </tr>
                {% endfor %}
                
                </tbody>
            </table>
        </div>
    </div>    
	
</div>