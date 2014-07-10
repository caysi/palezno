var RedmineTasks = {
table : document.getElementById('issue-list'),
head  : undefined,
tasks : undefined,




getHead : function() {
	if(!this.head) {
		this.head = this.table.getElementsByTagName('TH');
	}

	return this.head;
},
getHeadArray : function() {
	if(!this.headArray) {
		var heads = this.getHead();
		this.headArray = [];

		for(var i = 0; i<heads.length; i++) {
			this.headArray[i] = heads[i].classList[0];
		}
	}

	return this.headArray;
},

getTasks : function() {
	if(!this.tasks) {
		this.tasks = this.table.getElementsByTagName('TBODY')[0].getElementsByTagName('TR');
	}

	return this.tasks;
},


changeStyle : function() {
	for(i in this.getTasks()) {
		var task = this.getTasks()[i];
		if(typeof(task) !== 'object') { continue; }

		var taskCol = task.getElementsByTagName('TD');
		for(j in taskCol) {
			var col = taskCol[j];
			if(typeof(col) !== 'object') { continue; }

			var funcName = 'colum_'+this.getHeadArray()[j];
			if(this[funcName]) {
				this[funcName](taskCol[j], j);
			}
		}
	}
},

getColumHead : function(columId) {
	var colum = this.getHead()[columId];
	this.setElementStyle(colum);
	return colum;
},
setElementStyle : function(object) {
	object.style.width = 'auto';
	object.style.height = 'auto';
	object.style.margin = 0;
	object.style.padding = 0;
	object.style.textAlign = 'left';
},
/*colum_il_check : function() {
	console.log(1);
},
colum_il_check : function() {
	console.log(1);
},*/
colum_il_tracker : function(obj, columId) {
	var colum = this.getColumHead(columId);
	//if(!colum) {
		colum.innerHTML = colum.innerHTML.substring(0,3);
		colum.style.width = 'auto';
	//}
	obj.innerHTML = obj.innerHTML.substring(0,3);
},

colum_il_status : function(obj, columId) {
	var colum = this.getColumHead(columId);
	//if(!colum) {
		colum.innerHTML = colum.innerHTML.substring(0,3);
	//}
	obj.innerHTML = obj.innerHTML.substring(0,3);
},

colum_il_done_ratio : function(obj, columId) {
	var colum = this.getColumHead(columId);
	//if(!colum) {
		colum.innerHTML = colum.innerHTML.substring(0,3);
	//}
	//obj.innerHTML = obj.innerHTML.substring(0,3);
},

colum_il_subject : function(obj, columId) {
	var colum = this.getColumHead(columId);
	//if(!colum) {
		colum.innerHTML = colum.innerHTML.substring(0,3);
	//}
	//obj.innerHTML = obj.innerHTML.substring(0,3);
},

colum_il_author : function(obj, columId) {
	var colum = this.getColumHead(columId);
	//if(!colum) {
		colum.innerHTML = colum.innerHTML.substring(0,3);
	//}
	if(obj.firstElementChild) {
		obj.firstElementChild.innerHTML = obj.firstElementChild.innerHTML.substring(0,3);
	}
	this.setElementStyle(obj);
},

colum_il_assigned_to : function(obj, columId) {
	var colum = this.getColumHead(columId);
	//if(!colum) {
		colum.innerHTML = colum.innerHTML.substring(0,3);
	//}
	if(obj.firstElementChild) {
		obj.firstElementChild.innerHTML = obj.firstElementChild.innerHTML.substring(0,3);
	}
	this.setElementStyle(obj);
},

colum_il_due_date : function(obj, columId) {
	var colum = this.getColumHead(columId);
	//if(!colum) {
		colum.innerHTML = colum.innerHTML.substring(0,3);
	//}
	obj.innerHTML = obj.innerHTML.substring(0,3);
},

colum_il_updated_on : function(obj, columId) {
	var colum = this.getColumHead(columId);
	//if(!colum) {
		colum.innerHTML = colum.innerHTML.substring(0,3);
	//}
	obj.innerHTML = obj.innerHTML.substring(0,3);
},





}

RedmineTasks.changeStyle();
//console.log(Tasks.getTasks());

