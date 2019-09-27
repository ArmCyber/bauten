var Applicability = function(marks, saved_values){
    this.data = {};

    this.init = function(marks,saved_values) {
        this.data.marks = marks;
        this.registerElements();
        this.registerEvents();
        if (saved_values) this.insertSavedValues(saved_values);
    };

    this.registerElements = function(){
        this.elements = {
            exampleRow: $('.appl-row.example'),
            rows: $('#applicability-rows'),
            addButton: $('#add-row'),
            form: $('#part-form')
        };
    };

    this.registerEvents = function(){
        var self = this;
        self.elements.addButton.on('click', function(){ self.addRow(); });
        self.elements.rows
            .on('change', '.mark_id_select', function(){ self.markIdChangeEvent($(this)) })
            .on('change', '.model_id_select', function(){ self.modelIdChangeEvent($(this)) })
            .on('click', '.appl_row_delete', function(){ self.deleteBtnClickEvent($(this)) });
        self.elements.form.on('submit', function(e){ self.formSubmitEvent(e) })
    };

    this.addRow = function(values){
        var self = this,
            element = this.elements.exampleRow.clone().removeClass('example').appendTo(this.elements.rows),
            markIdSelect = element.find('.mark_id_select'),
            modelIdSelect = element.find('.model_id_select'),
            generationIdSelect = element.find('.generation_id_select');
        $.each(this.data.marks, function(key, obj){
            markIdSelect.append(self.newOption(obj.name, obj.id));
        });
        if (typeof values!=='undefined') {
            markIdSelect.val(values.mark).trigger('change');
            modelIdSelect.val(values.model).trigger('change');
            generationIdSelect.val(values.generation).trigger('change');
        }
        markIdSelect.select2();
        modelIdSelect.select2();
        generationIdSelect.select2();
        element.show();
    };

    this.newOption = function(name, id){
        return $('<option></option>').attr('value', id).text(name);
    };

    this.markIdChangeEvent = function(select){
        var self = this,
            markId = parseInt(select.val()),
            models = self.data.marks.find(x => (x.id === markId)).models,
            modelIdSelect = select.parents('.appl-row').find('.model_id_select');
        modelIdSelect.find('option').filter(function(item){
            return parseInt($(this).attr('value')) !== 0
        }).remove();
        $.each(models, function(key, model){
            self.newOption(model.name, model.id).appendTo(modelIdSelect);
        });
        modelIdSelect.removeAttr('disabled').trigger('change');
    };

    this.modelIdChangeEvent = function(select){
        var self = this,
            row = select.parents('.appl-row'),
            generationIdSelect = row.find('.generation_id_select'),
            modelId = parseInt(select.val());
        generationIdSelect.find('option').filter(function(item){
            return parseInt($(this).attr('value')) !== 0
        }).remove();
        if (modelId===0) {
            generationIdSelect.attr('disabled', 'disabled');
        }
        else {
            var markIdSelect = row.find('.mark_id_select'),
                markId = parseInt(markIdSelect.val()),
                generations = self.data.marks.find(x => x.id === markId).models.find(x => x.id === modelId).generations;
            $.each(generations, function(key, generation){
                self.newOption(generation.name, generation.id).appendTo(generationIdSelect);
            });
            generationIdSelect.removeAttr('disabled');
        }
        generationIdSelect.trigger('change');
    };

    this.deleteBtnClickEvent = function(btn){
        btn.parents('.appl-row').remove();
    };

    this.formSubmitEvent = function(e){
        this.elements.rows.css({'pointer-events':'none', 'opacity':'.5'}).find('option:disabled, select:disabled').removeAttr('disabled');
    };

    this.insertSavedValues = function(values) {
        var self=this;
        $.each(values, function(index, value){
            self.addRow({mark:value.mark_id, model:value.model_id, generation:value.generation_id});
        });
    };

    this.init(marks, saved_values);
};