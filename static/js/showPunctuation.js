	// utility functions for hiding / showing punctuation and type


        function clickHandler(id,_old,_new) {

                swapClass("color","black","white");
                swapClass("news","red","white");
                addRemoveDivWithMouseDown("_click", clickHandler);
        }


        function swapClass(id,class1,class2) {

                document.getElementById(id).className = (document.getElementById(id).className != class1) ?
        class1 : class2;
        }


        function addRemoveDivWithMouseDown(id,handler) {

                var clickDiv = document.getElementById(id);

                if (clickDiv == null) {

                        clickDiv = document.createElement("div");
                        clickDiv.id = "_click";
                        clickDiv.className = "fullContainer";
                        clickDiv.onmousedown = handler;
                        document.body.appendChild(clickDiv);

                } else {

                        var child = document.getElementById(id);
                        child.parentNode.removeChild(child);
                }
        }
