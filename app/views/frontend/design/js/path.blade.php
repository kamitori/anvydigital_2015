<script type="text/javascript">
var EPath = function() {
	var modeEdit="edit";
	var EPGroup;
	var EPGroupPath;
	var isdrap = false;
	var Point = [];
	var ActiId=0;
	function bind(){
		// When mousedown
		$(".EpathBox").on("mousedown",function(e){
			if(!isdrap)
				addPointer(e.offsetX,e.offsetY); //add begin point
		});
		// When Drag
		$(".EpathBox").on("mousemove",function(e){
			if(isdrap)
				drawControlLine(e.offsetX,e.offsetY);
		});
		// When mouseup, sometime mouse on this id, sometime mouse on .EpathBox
		$(".EpathBox").on("mouseup",function(e){
			endPointer();
		});
	}
	function begin(){
		var draw = Design.getDraw();
		if($(".EpathGroup").attr("id")!=undefined){
			$(".EpathGroup").remove();
		}
			EPGroupPath = draw.group().attr("class","EpathLineGroup");//line red
			EPGroup = draw.group().attr("class","EpathGroup"); //point and poliline
		var EPRect = draw.rect(500,500).attr({"class":"EpathBox","fill":"black","fill-opacity":"0.2"});
			EPGroup.add(EPRect);
		$(".EpathBox").css('cursor', 'crosshair');
		$(".add-path").css("display","none");
		$(".apply-path").css("display","block");
		bind();
	}
	function addPointer(x,y){
		var ActiPoint={};
			ActiPoint.beginX = x;
			ActiPoint.beginY = y;
			ActiPoint.controlX = x;
			ActiPoint.controlY = y;
			ActiPoint.RcontrolX = 2*ActiPoint.beginX - ActiPoint.controlX;
			ActiPoint.RcontrolY = 2*ActiPoint.beginY - ActiPoint.controlY;
			Point[ActiId]=ActiPoint;
			isdrap = true;
		var draw = Design.getDraw();
		var cir = draw.circle(10).cx(x).cy(y).attr("id","beginPoint_"+ActiId).fill("none").stroke({ color: '#fff', width: 1 });
		EPGroup.add(cir);
	}
	function endPointer(){
		if(isdrap){
			isdrap = false;
			$("#beginPoint_"+ActiId).remove();
			var draw = Design.getDraw();
			var cir = draw.circle(10).cx(Point[ActiId].beginX).cy(Point[ActiId].beginY).attr("id","beginPoint_"+ActiId).fill("blue").stroke({ color: '#fff', width: 1 });
				cir.draggable();
				cir.dragmove = function(e) {
					RedrawPointPath(this.x(), this.y(),this.node.id);
				};
			EPGroup.add(cir);
		}
		ActiId = Point.length;
	}
	function RedrawPointPath(x,y,item){
		if(item!=undefined){
			var arrid = item.split("_");
			ActiId = parseInt(arrid[1]);
			var dx,dy;
			dx = x-Point[ActiId].beginX;
			dy = y-Point[ActiId].beginY;
			Point[ActiId].beginX = x;
			Point[ActiId].beginY = y;
			Point[ActiId].controlX += dx;
			Point[ActiId].controlY += dy;
			drawControlLine(Point[ActiId].controlX,Point[ActiId].controlY,"point_"+ActiId);
			$("#"+item).mouseup(function(){ 
				endPointer();
			});
		}
		
		// drawMainPath();
	}
	function drawControlLine(x,y,item){
		var type='point';
		if(item!=undefined){
			var arrid = item.split("_");
			type = arrid[0];
			ActiId = parseInt(arrid[1]);
		}
		//calc control
		if(type=='point'){
			Point[ActiId].controlX = x;
			Point[ActiId].controlY = y;
			Point[ActiId].RcontrolX = 2*Point[ActiId].beginX - Point[ActiId].controlX;
			Point[ActiId].RcontrolY = 2*Point[ActiId].beginY - Point[ActiId].controlY;
		}else{ //Rcontrol
			Point[ActiId].RcontrolX = x;
			Point[ActiId].RcontrolY = y;
			Point[ActiId].controlX = 2*Point[ActiId].beginX - Point[ActiId].RcontrolX;
			Point[ActiId].controlY = 2*Point[ActiId].beginY - Point[ActiId].RcontrolY;
		}

		var draw = Design.getDraw();
		var polyline_id = "polyline_"+ActiId
		var polyline_id_R = "polylineR_"+ActiId
		var point_id = "point_"+ActiId
		var point_id_R = "pointR_"+ActiId
		
		//clear point and polyline
		$("#"+polyline_id).remove();
		$("#"+polyline_id_R).remove();
		$("#"+point_id).remove();
		$("#"+point_id_R).remove();

		//redraw point and polyline
		var polyline = draw.polyline([[Point[ActiId].beginX,Point[ActiId].beginY],[Point[ActiId].controlX,Point[ActiId].controlY]]);
			polyline.attr({"id":polyline_id, "class":"polyline"}).fill('none').stroke({ color: '#fff', width: 2 });
		var polylineR = draw.polyline([[Point[ActiId].beginX,Point[ActiId].beginY],[Point[ActiId].RcontrolX,Point[ActiId].RcontrolY]]);
			polylineR.attr({"id":polyline_id_R, "class":"polyline"}).fill('none').stroke({ color: '#fff', width: 2 });
		var cir = draw.circle(10).cx(Point[ActiId].controlX).cy(Point[ActiId].controlY).attr({"id":point_id}).fill("#fff").stroke("none");
			cir.draggable();
			cir.dragmove = function(e) {
				drawControlLine(this.x()+5, this.y()+5,this.node.id);
			};
		var cirR = draw.circle(10).cx(Point[ActiId].RcontrolX).cy(Point[ActiId].RcontrolY).attr({"id":point_id_R}).fill("#fff").stroke("none");
			cirR.draggable();
			cirR.dragmove = function(e) {
				drawControlLine(this.x()+5, this.y()+5,this.node.id);
			};
		EPGroup.add(polyline);
		EPGroup.add(polylineR);
		EPGroup.add(cir);
		EPGroup.add(cirR);
		drawMainPath();
		// When mouseup, sometime mouse on this id, sometime mouse on .EpathBox
		$("#"+polyline_id+",#"+polyline_id_R+",#"+point_id+",#"+point_id_R).mouseup(function(){ 
			endPointer();
		});
	}
	//Draw main path
	function drawMainPath(){
		var draw = Design.getDraw();
		var d = 'M'+Point[0].beginX+","+Point[0].beginY+" ";
		for (var i = 1; i < Point.length; i++) {
			if(i==1)
				d += " C"+Point[i-1].controlX+","+Point[i-1].controlY+" "+Point[i].controlX+","+Point[i].controlY+" "+Point[i].beginX+","+Point[i].beginY+" ";
			else
				d += " S"+Point[i].controlX+","+Point[i].controlY+" "+Point[i].beginX+","+Point[i].beginY+" ";

			if(i==Point.length-1){
				$("#main_textpath").remove();
				var path = draw.path(d).attr({"id":"main_textpath", "class":"MainPath"}).fill('none').stroke({ color: '#f00', width: 5 });
				EPGroupPath.add(path);
			}
		};
		console.log(d);		
	}

	function end(){
		$(".EpathBox").remove();
		$(".add-path").css("display","block");
		$(".apply-path").css("display","none");
	}
	return {
		bind : function() {
			bind();
		},
		addPath: function() {
			modeEdit = "add";
			begin();
		},
		applyPath:function(){
			modeEdit = "";
			end();
		},
		removerPath:function(){
			modeEdit = "";
			end();
		}
	}
}();
</script>