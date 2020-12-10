import * as ListFun from './script-select';
import * as DateFun from './script-date';
import * as ValidateFun from './script-validation';
import * as PeFun from './script-pe';
import Chart from 'chart.js';

const works = require('../data/work-list.json');
const countries = require('../data/country-list.json');

var QRCode = require('qrcode');

$(function () {
    //*Create Person Script
    $('#person_create').on('load', function () {
        DateFun.dateDropperInit();
        ListFun.regencyLocationListInit('#birth_regencies');
        ListFun.listInit(works, '#works');
        ListFun.fullLocationListInit('card')
        ValidateFun.createPersonValidationInit()
        ValidateFun.updatePersonValidationInit()
    })

    $('#pe_create').on('load', function () {
        //*PE Script
        //--PE Validation
        ValidateFun.createPeValidationInit()
        ListFun.listInit(['Nasofaring', 'Orofaring', 'Nasofaring-Orofaring'], '#swab_types');
        ListFun.listInit(['Normal', 'Cito'], '#swab_priorities');
        ListFun.listInit(['Internal', 'Sintang', 'Pontianak'], '#swab_locations');

        //--Full Location Living Init
        ListFun.fullLocationListInit('living')

        //--NIK Check
        // PeFun.nikCheck()

        //--Symptoms
        PeFun.radioShowHideToggle("symptoms")
        PeFun.checkboxShowHideToggle("demam")
        PeFun.checkboxShowHideToggle("symptoms_else")

        //--Comorbidities
        PeFun.radioShowHideToggle("comorbidities")
        PeFun.checkboxShowHideToggle("comorbidities_else")

        //--Diagnoses
        PeFun.radioShowHideToggle("diagnoses")
        PeFun.checkboxShowHideToggle("diagnoses_else")

        //--Hospital
        PeFun.radioShowHideToggle("hospital")
        $('#hospital_statuses').selectpicker()

        //--Travel History
        //-----International
        PeFun.radioShowHideToggle("travel_history_international")
        ListFun.listInit(countries, '#travel_history_international_countries')

        //-----Domestic
        PeFun.radioShowHideToggle("travel_history_domestic")
        ListFun.regencyLocationListInit('#travel_history_domestic_regencies');

        //-----Living
        PeFun.radioShowHideToggle("travel_history_living")
        ListFun.regencyLocationListInit('#travel_history_living_regencies');

        //--Contact History
        //-----Contact
        PeFun.radioShowHideToggle("contact_history_normal")
        $('#contact_history_normal_statuses').selectpicker()
        //-----Close Contact
        PeFun.radioShowHideToggle("contact_history_close")
        $('#contact_history_close_statuses').selectpicker()

        //--Contact History
        //-----ISPA
        //-----Pet
        PeFun.radioShowHideToggle("pet")
        //-----Health Worker
        PeFun.radioShowHideToggle("health_worker")
    })

    $('#btn-show-result').on('click', function () {
        $('#btn-show-result').hide()
        // var audio = document.getElementById("bgsound1");
        // audio.play()
        $('#result').after(`<h5 id="wait">Mohon menunggu</h5>`);
        setTimeout(function () {
            $('#wait').hide();
            $('#result').show();

        }, 100)

    })

    //*Result Script
    QRCode.toString($('#qrcode').data('link'), {
        margin: 0
    }, function (err, string) {
        $('#qrcode').html(string)
        $('#qrcode>svg>path').removeAttr('fill')
        $('#qrcode>svg>path').removeAttr('stroke')
    })


})
