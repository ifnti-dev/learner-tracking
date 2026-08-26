import $ from 'jquery';
import { Input } from 'postcss';

const all_niveau = ['', 'CE2', 'CM1', 'CM2', '6ème trimestriel', '6ème semestriel', '5ème trimestriel', '5ème semestriel', '4ème trimestriel', '4ème semestriel',
    '3ème trimestriel', '3ème semestriel', 'Seconde trimestriel', 'Seconde semestriel', 'Première trimestriel', 'Première semestriel', 'Terminale trimestriel', 'Terminale semestriel']


let niveau_id = $('#niveau_id').val();
function get_niveau_id() {
    niveau_id = $('#niveau_id').val();

}
function add_row() {
    const table_body = $('#tbody')
    const table_thead_tr = $('#thead_tr')
    const th_speciales = $('.special');
    th_speciales.remove()
    console.log(table_body)
    table_body.empty();
    let bladeInputHtml = $('#file-input-template').html();

    let ajout = ''

    if ([4, 5, 12, 13, 16, 17].includes(Number(niveau_id))) {
        
        if ([4, 5].includes(Number(niveau_id))) {
            let th_special = `<th class=" special w-1/4 px-5 py-3 text-center text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                CEPD
                                            </th>`;

            table_thead_tr.append(th_special);
            let rest = "<tr class='border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50/50 dark:hover:bg-white/[0.01]'>";
            let td_niveau = `<td class="px-5 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-sm align-middle">
                            ${all_niveau[5]}
                         </td>`;
            rest += td_niveau
            for (let j = 1; j < 5; j++) {

                let $inputClone = $(bladeInputHtml);

                let dynamicName = `bulletins[${niveau_id}][${j}]`;
                $inputClone.attr('name', dynamicName);

                let modifiedInputHtml = $inputClone.prop('outerHTML');

                let td_input = `<td class="px-3 py-3 text-center align-middle">
                                <div class="w-full">${modifiedInputHtml}</div>
                            </td>`;

                rest += td_input
            }
            rest += "</tr>"
            ajout += rest
        }

        if ([12, 13].includes(Number(niveau_id))) {
            let th_special = `<th class=" special w-1/4 px-5 py-3 text-center text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                BEPC
                                            </th>`;

            table_thead_tr.append(th_special);
            let rest = "<tr class='border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50/50 dark:hover:bg-white/[0.01]'>";
            let td_niveau = `<td class="px-5 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-sm align-middle">
                            ${all_niveau[niveau_id]}
                         </td>`;
            rest += td_niveau
            for (let j = 1; j < 5; j++) {

                let $inputClone = $(bladeInputHtml);

                let dynamicName = `bulletins[${niveau_id}][${j}]`;
                $inputClone.attr('name', dynamicName);

                let modifiedInputHtml = $inputClone.prop('outerHTML');

                let td_input = `<td class="px-3 py-3 text-center align-middle">
                                <div class="w-full">${modifiedInputHtml}</div>
                            </td>`;

                rest += td_input
            }
            rest += "</tr>"
            ajout += rest
        }

        if ([16, 17].includes(Number(niveau_id))) {
            let th_special = `<th class=" special w-1/4 px-5 py-3 text-center text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                BAC1
                                            </th>`;
            th_special += `<th class=" special w-1/4 px-5 py-3 text-center text-theme-xs font-medium text-gray-500 dark:text-gray-400">
                                                BAC2
                                            </th>`;


            table_thead_tr.append(th_special);
            let rest = "<tr class='border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50/50 dark:hover:bg-white/[0.01]'>";
            let td_niveau = `<td class="px-5 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-sm align-middle">
                            ${all_niveau[niveau_id]}
                         </td>`;
            rest += td_niveau
            for (let j = 1; j <= 5; j++) {

                let $inputClone = $(bladeInputHtml);

                let dynamicName = `bulletins[${niveau_id}][${j}]`;
                $inputClone.attr('name', dynamicName);

                let modifiedInputHtml = $inputClone.prop('outerHTML');

                let td_input = `<td class="px-3 py-3 text-center align-middle">
                                <div class="w-full">${modifiedInputHtml}</div>
                            </td>`;

                rest += td_input
            }
            rest += "</tr>"
            ajout += rest
        }
        
    } else {
        let debut = 1
        

        if(niveau_id > 3 && niveau_id <= 11 ){
            debut = 4
        }
        if( niveau_id > 11 ){
            debut = 12
        }



        for (let i = debut; i <= niveau_id; i++) {
            let rest = "<tr class='border-b border-gray-100 dark:border-gray-800 hover:bg-gray-50/50 dark:hover:bg-white/[0.01]'>";
            let td_niveau = `<td class="px-5 py-4 text-left font-semibold text-gray-700 dark:text-gray-300 text-sm align-middle">
                            ${all_niveau[i]} 
                         </td>`;
            rest += td_niveau
            for (let j = 1; j <=3; j++) {

                let $inputClone = $(bladeInputHtml);

                let dynamicName = `bulletins[${i}][${j}]`;
                $inputClone.attr('name', dynamicName);

                let modifiedInputHtml = $inputClone.prop('outerHTML');

                let td_input = `<td class="px-3 py-3 text-center align-middle">
                                <div class="w-full">${modifiedInputHtml}</div>
                            </td>`;

                rest += td_input
            }
            rest += "</tr>"
            ajout += rest
        }

    }



    table_body.append(ajout);

}


const button_ajouter_bulletins = $('#ajouter-bulletins')

button_ajouter_bulletins.on('click', function () {
    const div_table_bulltins = $('#table_bulltins')
    div_table_bulltins.css({
        'display': 'block'
    });

    get_niveau_id()
    add_row()



});

