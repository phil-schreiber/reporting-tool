{% include 'partials/flash-messages.volt' %}
{{ content() }}
<div class="container">    
 <div class="col-xs-12">
    	<h1>Projektübersicht {{date('Y')}}</h1>        
        
        
            <table>
                <thead>
                    <tr>
                        <th>{{tr('projecttype')}}</th>
                        <th>erbracht</th>
                        <th>insgesamt</th>
                        <th>Themen</th>
                    </tr>
                </thead>
                {% for index,spec in specscount %}
                <tr>
                    <td>{{spec["title"]}}</td>
                    <td style="text-align: center;">
                        {%if arrayKeyExists(index,projectcount) %}
                        {{projectcount[index]}}
                        {% else %}
                        0
                        {% endif %}
                    </td>
                    <td style="text-align: center;">{{spec["amount"]}}</td>
                    <td>
                        <ul>
                            {% if isset(projects[index]) %}
                            {% for project in projects[index] %}
                            <li><a href="{{host}}{{baseurl}}projects/update/{{project.uid}}">{{project.title}}</a></li>
                            {% endfor %}
                            {% endif %}
                        </ul>
                    </td>
                </tr>
                {% endfor %}
            </table>
        </div>
    </div>    
	
</div>