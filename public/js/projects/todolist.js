import TaskList from './TaskList.js';
import TaskForm from './TaskForm.js';

'use strict';

const app = new Vue({
    el: '#app',
    components: {
        // Enregistrement du composant (pour pouvoir l'utiliser)
        TaskList,
        TaskForm
    },
    data: {
        taskList: [{
            title: 'Lire le roman Colossus',
            priority: 'importante',
            checked: false
        }, {
            title: 'Laisser un commentaire',
            priority: 'faible',
            checked: false
        }, {
            title: 'Tester cette task-list',
            priority: 'normale',
            checked: false
        }],
        newTask: {
            title: '',
            priority: 1
        }
    }
});