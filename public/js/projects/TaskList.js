export default Vue.component('task-list', {
    template: `<section id="task-list">
                <h2>Liste des taches</h2>
                <ul class="list-unstyled">
                    <li v-for="task in reverseTaskList">
                        <div class="checkbox">
                            <label v-bind:class="{checked: task.checked}">
                                <input v-model="task.checked" type="checkbox" /> {{ task.title }} <span class="badge" v-bind:class="{'badge-danger': task.priority == 'importante', 'badge-info': task.priority == 'normale', 'badge-secondary': task.priority == 'faible'}">Priorité {{ task.priority }}</span>
                            </label>
                        </div>
                    </li>
                </ul>
                <button v-on:click="deleteCompletedTasks" class="bouton">Supprimer les taches terminées</button>
            </section>`,
    computed: {
        reverseTaskList: function () {
            return this.taskList.reverse();
        }
    },
    props: ['taskList'],
    methods: {
        deleteCompletedTasks: function () {
            const tasksNotCompleted = [];
            
            for (let i = 0; i < this.taskList.length; i++) {
                if (this.taskList[i].checked == false) {
                    tasksNotCompleted.push(this.taskList[i]);
                }
            }
            
            this.taskList = tasksNotCompleted.reverse();
        }
    }
});