            <h5 class="text-center mb-3">
                <i class="fas fa-arrow-left mr-4 cursor_pointer h3" title="semaine précédente" onclick="changeDatePlanning(-7)"></i>
                <i class="fas fa-arrow-left mr-3 cursor_pointer" title="jour précédent" onclick="changeDatePlanning(-1)"></i>
                <span id="display-date-planning" date="{{$date}}" class="h3">{{$date_planning}}</span>
                <i class="fas fa-arrow-right ml-3 cursor_pointer" title="jour suivant" onclick="changeDatePlanning(1)"></i>
                <i class="fas fa-arrow-right ml-4 cursor_pointer h3" title="semaine suivante" onclick="changeDatePlanning(7)"></i>
            </h5>
                <table class="table table-bordered pony-table">
                    <thead class="text-center">
                        <tr>
                            <th>&nbsp;</th>
                            <th class="text-center align-middle">Grand manège</th>
                            <th class="text-center align-middle">Petit manège</th>
                            <th class="text-center align-middle">Carrière</th>
                            <th class="text-center align-middle">Promenade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">7h</th>
                            <td x="07:00:00" y="1" class="p-2"></td>
                            <td x="07:00:00" y="2" class="p-2"></td>
                            <td x="07:00:00" y="3" class="p-2"></td>
                            <td x="07:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="07:15:00" y="1" class="p-2"></td>
                            <td x="07:15:00" y="2" class="p-2"></td>
                            <td x="07:15:00" y="3" class="p-2"></td>
                            <td x="07:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="07:30:00" y="1" class="p-2"></td>
                            <td x="07:30:00" y="2" class="p-2"></td>
                            <td x="07:30:00" y="3" class="p-2"></td>
                            <td x="07:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="07:45:00" y="1" class="p-2"></td>
                            <td x="07:45:00" y="2" class="p-2"></td>
                            <td x="07:45:00" y="3" class="p-2"></td>
                            <td x="07:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">8h</th>
                            <td x="08:00:00" y="1" class="p-2"></td>
                            <td x="08:00:00" y="2" class="p-2"></td>
                            <td x="08:00:00" y="3" class="p-2"></td>
                            <td x="08:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="08:15:00" y="1" class="p-2"></td>
                            <td x="08:15:00" y="2" class="p-2"></td>
                            <td x="08:15:00" y="3" class="p-2"></td>
                            <td x="08:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="08:30:00" y="1" class="p-2"></td>
                            <td x="08:30:00" y="2" class="p-2"></td>
                            <td x="08:30:00" y="3" class="p-2"></td>
                            <td x="08:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="08:45:00" y="1" class="p-2"></td>
                            <td x="08:45:00" y="2" class="p-2"></td>
                            <td x="08:45:00" y="3" class="p-2"></td>
                            <td x="08:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">9h</th>
                            <td x="09:00:00" y="1" class="p-2"></td>
                            <td x="09:00:00" y="2" class="p-2"></td>
                            <td x="09:00:00" y="3" class="p-2"></td>
                            <td x="09:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="09:15:00" y="1" class="p-2"></td>
                            <td x="09:15:00" y="2" class="p-2"></td>
                            <td x="09:15:00" y="3" class="p-2"></td>
                            <td x="09:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="09:30:00" y="1" class="p-2"></td>
                            <td x="09:30:00" y="2" class="p-2"></td>
                            <td x="09:30:00" y="3" class="p-2"></td>
                            <td x="09:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="09:45:00" y="1" class="p-2"></td>
                            <td x="09:45:00" y="2" class="p-2"></td>
                            <td x="09:45:00" y="3" class="p-2"></td>
                            <td x="09:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">10h</th>
                            <td x="10:00:00" y="1" class="p-2"></td>
                            <td x="10:00:00" y="2" class="p-2"></td>
                            <td x="10:00:00" y="3" class="p-2"></td>
                            <td x="10:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="10:15:00" y="1" class="p-2"></td>
                            <td x="10:15:00" y="2" class="p-2"></td>
                            <td x="10:15:00" y="3" class="p-2"></td>
                            <td x="10:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="10:30:00" y="1" class="p-2"></td>
                            <td x="10:30:00" y="2" class="p-2"></td>
                            <td x="10:30:00" y="3" class="p-2"></td>
                            <td x="10:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="10:45:00" y="1" class="p-2"></td>
                            <td x="10:45:00" y="2" class="p-2"></td>
                            <td x="10:45:00" y="3" class="p-2"></td>
                            <td x="10:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">11h</th>
                            <td x="11:00:00" y="1" class="p-2"></td>
                            <td x="11:00:00" y="2" class="p-2"></td>
                            <td x="11:00:00" y="3" class="p-2"></td>
                            <td x="11:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="11:15:00" y="1" class="p-2"></td>
                            <td x="11:15:00" y="2" class="p-2"></td>
                            <td x="11:15:00" y="3" class="p-2"></td>
                            <td x="11:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="11:30:00" y="1" class="p-2"></td>
                            <td x="11:30:00" y="2" class="p-2"></td>
                            <td x="11:30:00" y="3" class="p-2"></td>
                            <td x="11:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="11:45:00" y="1" class="p-2"></td>
                            <td x="11:45:00" y="2" class="p-2"></td>
                            <td x="11:45:00" y="3" class="p-2"></td>
                            <td x="11:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">12h</th>
                            <td x="12:00:00" y="1" class="p-2"></td>
                            <td x="12:00:00" y="2" class="p-2"></td>
                            <td x="12:00:00" y="3" class="p-2"></td>
                            <td x="12:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="12:15:00" y="1" class="p-2"></td>
                            <td x="12:15:00" y="2" class="p-2"></td>
                            <td x="12:15:00" y="3" class="p-2"></td>
                            <td x="12:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="12:30:00" y="1" class="p-2"></td>
                            <td x="12:30:00" y="2" class="p-2"></td>
                            <td x="12:30:00" y="3" class="p-2"></td>
                            <td x="12:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="12:45:00" y="1" class="p-2"></td>
                            <td x="12:45:00" y="2" class="p-2"></td>
                            <td x="12:45:00" y="3" class="p-2"></td>
                            <td x="12:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">13h</th>
                            <td x="13:00:00" y="1" class="p-2"></td>
                            <td x="13:00:00" y="2" class="p-2"></td>
                            <td x="13:00:00" y="3" class="p-2"></td>
                            <td x="13:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="13:15:00" y="1" class="p-2"></td>
                            <td x="13:15:00" y="2" class="p-2"></td>
                            <td x="13:15:00" y="3" class="p-2"></td>
                            <td x="13:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="13:30:00" y="1" class="p-2"></td>
                            <td x="13:30:00" y="2" class="p-2"></td>
                            <td x="13:30:00" y="3" class="p-2"></td>
                            <td x="13:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="13:45:00" y="1" class="p-2"></td>
                            <td x="13:45:00" y="2" class="p-2"></td>
                            <td x="13:45:00" y="3" class="p-2"></td>
                            <td x="13:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">14h</th>
                            <td x="14:00:00" y="1" class="p-2"></td>
                            <td x="14:00:00" y="2" class="p-2"></td>
                            <td x="14:00:00" y="3" class="p-2"></td>
                            <td x="14:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="14:15:00" y="1" class="p-2"></td>
                            <td x="14:15:00" y="2" class="p-2"></td>
                            <td x="14:15:00" y="3" class="p-2"></td>
                            <td x="14:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="14:30:00" y="1" class="p-2"></td>
                            <td x="14:30:00" y="2" class="p-2"></td>
                            <td x="14:30:00" y="3" class="p-2"></td>
                            <td x="14:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="14:45:00" y="1" class="p-2"></td>
                            <td x="14:45:00" y="2" class="p-2"></td>
                            <td x="14:45:00" y="3" class="p-2"></td>
                            <td x="14:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">15h</th>
                            <td x="15:00:00" y="1" class="p-2"></td>
                            <td x="15:00:00" y="2" class="p-2"></td>
                            <td x="15:00:00" y="3" class="p-2"></td>
                            <td x="15:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="15:15:00" y="1" class="p-2"></td>
                            <td x="15:15:00" y="2" class="p-2"></td>
                            <td x="15:15:00" y="3" class="p-2"></td>
                            <td x="15:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="15:30:00" y="1" class="p-2"></td>
                            <td x="15:30:00" y="2" class="p-2"></td>
                            <td x="15:30:00" y="3" class="p-2"></td>
                            <td x="15:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="15:45:00" y="1" class="p-2"></td>
                            <td x="15:45:00" y="2" class="p-2"></td>
                            <td x="15:45:00" y="3" class="p-2"></td>
                            <td x="15:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">16h</th>
                            <td x="16:00:00" y="1" class="p-2"></td>
                            <td x="16:00:00" y="2" class="p-2"></td>
                            <td x="16:00:00" y="3" class="p-2"></td>
                            <td x="16:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="16:15:00" y="1" class="p-2"></td>
                            <td x="16:15:00" y="2" class="p-2"></td>
                            <td x="16:15:00" y="3" class="p-2"></td>
                            <td x="16:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="16:30:00" y="1" class="p-2"></td>
                            <td x="16:30:00" y="2" class="p-2"></td>
                            <td x="16:30:00" y="3" class="p-2"></td>
                            <td x="16:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="16:45:00" y="1" class="p-2"></td>
                            <td x="16:45:00" y="2" class="p-2"></td>
                            <td x="16:45:00" y="3" class="p-2"></td>
                            <td x="16:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">17h</th>
                            <td x="17:00:00" y="1" class="p-2"></td>
                            <td x="17:00:00" y="2" class="p-2"></td>
                            <td x="17:00:00" y="3" class="p-2"></td>
                            <td x="17:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="17:15:00" y="1" class="p-2"></td>
                            <td x="17:15:00" y="2" class="p-2"></td>
                            <td x="17:15:00" y="3" class="p-2"></td>
                            <td x="17:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="17:30:00" y="1" class="p-2"></td>
                            <td x="17:30:00" y="2" class="p-2"></td>
                            <td x="17:30:00" y="3" class="p-2"></td>
                            <td x="17:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="17:45:00" y="1" class="p-2"></td>
                            <td x="17:45:00" y="2" class="p-2"></td>
                            <td x="17:45:00" y="3" class="p-2"></td>
                            <td x="17:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">18h</th>
                            <td x="18:00:00" y="1" class="p-2"></td>
                            <td x="18:00:00" y="2" class="p-2"></td>
                            <td x="18:00:00" y="3" class="p-2"></td>
                            <td x="18:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="18:15:00" y="1" class="p-2"></td>
                            <td x="18:15:00" y="2" class="p-2"></td>
                            <td x="18:15:00" y="3" class="p-2"></td>
                            <td x="18:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="18:30:00" y="1" class="p-2"></td>
                            <td x="18:30:00" y="2" class="p-2"></td>
                            <td x="18:30:00" y="3" class="p-2"></td>
                            <td x="18:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="18:45:00" y="1" class="p-2"></td>
                            <td x="18:45:00" y="2" class="p-2"></td>
                            <td x="18:45:00" y="3" class="p-2"></td>
                            <td x="18:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">19h</th>
                            <td x="19:00:00" y="1" class="p-2"></td>
                            <td x="19:00:00" y="2" class="p-2"></td>
                            <td x="19:00:00" y="3" class="p-2"></td>
                            <td x="19:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="19:15:00" y="1" class="p-2"></td>
                            <td x="19:15:00" y="2" class="p-2"></td>
                            <td x="19:15:00" y="3" class="p-2"></td>
                            <td x="19:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="19:30:00" y="1" class="p-2"></td>
                            <td x="19:30:00" y="2" class="p-2"></td>
                            <td x="19:30:00" y="3" class="p-2"></td>
                            <td x="19:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="19:45:00" y="1" class="p-2"></td>
                            <td x="19:45:00" y="2" class="p-2"></td>
                            <td x="19:45:00" y="3" class="p-2"></td>
                            <td x="19:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">20h</th>
                            <td x="20:00:00" y="1" class="p-2"></td>
                            <td x="20:00:00" y="2" class="p-2"></td>
                            <td x="20:00:00" y="3" class="p-2"></td>
                            <td x="20:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="20:15:00" y="1" class="p-2"></td>
                            <td x="20:15:00" y="2" class="p-2"></td>
                            <td x="20:15:00" y="3" class="p-2"></td>
                            <td x="20:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="20:30:00" y="1" class="p-2"></td>
                            <td x="20:30:00" y="2" class="p-2"></td>
                            <td x="20:30:00" y="3" class="p-2"></td>
                            <td x="20:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="20:45:00" y="1" class="p-2"></td>
                            <td x="20:45:00" y="2" class="p-2"></td>
                            <td x="20:45:00" y="3" class="p-2"></td>
                            <td x="20:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">21h</th>
                            <td x="21:00:00" y="1" class="p-2"></td>
                            <td x="21:00:00" y="2" class="p-2"></td>
                            <td x="21:00:00" y="3" class="p-2"></td>
                            <td x="21:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="21:15:00" y="1" class="p-2"></td>
                            <td x="21:15:00" y="2" class="p-2"></td>
                            <td x="21:15:00" y="3" class="p-2"></td>
                            <td x="21:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="21:30:00" y="1" class="p-2"></td>
                            <td x="21:30:00" y="2" class="p-2"></td>
                            <td x="21:30:00" y="3" class="p-2"></td>
                            <td x="21:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="21:45:00" y="1" class="p-2"></td>
                            <td x="21:45:00" y="2" class="p-2"></td>
                            <td x="21:45:00" y="3" class="p-2"></td>
                            <td x="21:45:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <th class="text-center align-middle" rowspan="4">22h</th>
                            <td x="22:00:00" y="1" class="p-2"></td>
                            <td x="22:00:00" y="2" class="p-2"></td>
                            <td x="22:00:00" y="3" class="p-2"></td>
                            <td x="22:00:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="22:15:00" y="1" class="p-2"></td>
                            <td x="22:15:00" y="2" class="p-2"></td>
                            <td x="22:15:00" y="3" class="p-2"></td>
                            <td x="22:15:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="22:30:00" y="1" class="p-2"></td>
                            <td x="22:30:00" y="2" class="p-2"></td>
                            <td x="22:30:00" y="3" class="p-2"></td>
                            <td x="22:30:00" y="4" class="p-2"></td>
                        </tr>
                        <tr>
                            <td x="22:45:00" y="1" class="p-2"></td>
                            <td x="22:45:00" y="2" class="p-2"></td>
                            <td x="22:45:00" y="3" class="p-2"></td>
                            <td x="22:45:00" y="4" class="p-2"></td>
                        </tr>
                    </tbody>
                </table>
