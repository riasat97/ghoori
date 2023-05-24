(function(){

    $(document).ready(function() {
        $('#startDatePicker')
            .datepicker({
                format: 'mm/dd/yyyy'
            })
            .on('changeDate', function(e) {
                // Revalidate the start date field
                $('#eventForm').formValidation('revalidateField', 'startDate');
            });

        $('#endDatePicker')
            .datepicker({
                format: 'mm/dd/yyyy'
            })
            .on('changeDate', function(e) {
                $('#eventForm').formValidation('revalidateField', 'endDate');
            });

        $('#eventForm')
            .formValidation({
                framework: 'bootstrap',
                icon: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                },
                fields: {
                    startDate: {
                        validators: {
                            notEmpty: {
                                message: 'The start date is required'
                            },
                            date: {
                                format: 'MM/DD/YYYY',
                                max: 'endDate',
                                message: 'The start date is not a valid'
                            }
                        }
                    },
                    endDate: {
                        validators: {
                            notEmpty: {
                                message: 'The end date is required'
                            },
                            date: {
                                format: 'MM/DD/YYYY',
                                min: 'startDate',
                                message: 'The end date is not a valid'
                            }
                        }
                    }
                }
            })
            .on('success.field.fv', function(e, data) {
                if (data.field === 'startDate' && data.fv.isValidField('endDate') === false) {
                    // We need to revalidate the end date
                    data.fv.revalidateField('endDate');
                }

                if (data.field === 'endDate' && data.fv.isValidField('startDate') === false) {
                    // We need to revalidate the start date
                    data.fv.revalidateField('startDate');
                }
            });
    });


})();