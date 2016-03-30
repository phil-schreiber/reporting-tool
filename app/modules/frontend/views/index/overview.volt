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
                        <th width="70">in Arbeit</th>
                        <th>Plan</th>
                        <th>Projekte</th>
                    </tr>
                </thead>
                <tbody>
                {% for index,spec in specscount %}
                <tr {% if index %2 ==0 %}class="even"{% else %} class="odd"{% endif %}>
                    <td style="vertical-align: top">{{spec["title"]}}</td>
                    <td style="vertical-align: top">
                        {%if arrayKeyExists(index,projectcount) %}
                        {{projectcount[index]}}
                        {% else %}
                        0
                        {% endif %}
                    </td>
                    <td style="vertical-align: top">
                        {%if arrayKeyExists(index,projectprepcount) %}
                        {{projectprepcount[index]}}
                        {% else %}
                        0
                        {% endif %}
                        
                    </td>
                    <td style="vertical-align: top">{{spec["amount"]}}</td>
                    <td style="vertical-align: top">
                        <ul style="margin:0;padding-left:13px">
                            {% if isset(projects[index]) %}
                            {% for project in projects[index] %}
                            <li>{{project.title}}</li>
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