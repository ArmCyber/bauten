var EngineApplicability = function(marks, saved_values){
    this.data = {};

    this.init = function(marks,saved_values) {
        this.data.marks = marks;
        this.registerElements();
        this.registerEvents();
        if (saved_values) this.insertSavedValues(saved_values);
    };

    this.registerElements = function(){
        this.elements = {
            exampleRow: $('.engine-row.example'),
            rows: $('#engine-rows'),
            addButton: $('#add-engine-row'),
            form: $('#part-form')
        };
    };

    this.registerEvents = function(){
        var self = this;
        self.elements.addButton.on('click', function(){ self.addRow(); });
        self.elements.rows
            .on('change', '.mark_id_select', function(){ self.markIdChangeEvent($(this)) })
            .on('click', '.engine_row_delete', function(){ self.deleteBtnClickEvent($(this)) });
        self.elements.form.on('submit', function(e){ self.formSubmitEvent(e) })
    };

    this.addRow = function(values){
        var self = this,
            element = this.elements.exampleRow.clone().removeClass('example').appendTo(this.elements.rows),
            markIdSelect = element.find('.mark_id_select'),
            engineIdSelect = element.find('.engine_id_select');
        $.each(this.data.marks, function(key, obj){
            markIdSelect.append(self.newOption(obj.name, obj.id));
        });
        if (typeof values!=='undefined') {
            markIdSelect.val(values.mark).trigger('change');
            engineIdSelect.val(values.engine).trigger('change');
        }
        markIdSelect.select2();
        engineIdSelect.select2();
        element.show();
    };

    this.newOption = function(name, id){
        return $('<option></option>').attr('value', id).text(name);
    };

    this.markIdChangeEvent = function(select){
        var self = this,
            markId = parseInt(select.val()),
            engines = self.data.marks.find(x => (x.id === markId)).engines,
            engineIdSelect = select.parents('.engine-row').find('.engine_id_select');
        engineIdSelect.find('option').filter(function(item){
            return parseInt($(this).attr('value')) !== 0
        }).remove();
        $.each(engines, function(key, model){
            self.newOption(model.name, model.id).appendTo(engineIdSelect);
        });
        engineIdSelect.removeAttr('disabled').trigger('change');
    };

    this.deleteBtnClickEvent = function(btn){
        btn.parents('.engine-row').remove();
    };

    this.formSubmitEvent = function(e){
        this.elements.rows.css({'pointer-events':'none', 'opacity':'.5'}).find('option:disabled, select:disabled').removeAttr('disabled');
    };

    this.insertSavedValues = function(values) {
        var self=this;
        $.each(values, function(index, value){
            self.addRow({mark:value.mark_id, engine:value.engine_id});
        });
    };

    this.init(marks, saved_values);
};
