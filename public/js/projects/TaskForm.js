export default Vue.component('task-form', {
    template: `<form class="form-inline">
                    <fieldset>
                        <h2>Créer une nouvelle tache</h2>
                        
                        <label class="sr-only" for="task">Tache</label>
                        <input v-model="newTask.title" type="text" class="form-control mb-2 mr-sm-2" id="task" placeholder="Nom de la tache">
                        
                        <label class="sr-only" for="priority">Priorité</label>
                        <select v-model="newTask.priority" id="priority" class="form-control mb-2 mr-sm-2">
                            <option value="1">Importante</option>
                            <option value="2">Normale</option>
                            <option value="3">Faible</option>
                        </select>
                        
                        <button v-on:click.prevent="addTask" class="bouton">Ajouter</button>
                    </fieldset>
                </form>`,
    data: function() {
        return {
            newTask: {
                title: '',
                priority: 1
            }
        }
    },
    
    props: ['taskList'],
                
    methods: {
        addTask: function () {
            let priority;
            
            switch (parseInt(this.newTask.priority)) {
                case 1:
                    priority = 'importante';
                    break;
                case 2:
                    priority = 'normale';
                    break;
                case 3:
                    priority = 'faible';
                    break;
            }
            
            this.taskList.push({
                title: this.newTask.title,
                priority: priority,
                checked: false
            });
        }
    }
});