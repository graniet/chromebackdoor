(function() {
	function setBorderColor(r, g, b)
	{
		hexR = r.toString(16);
		hexG = g.toString(16);
		hexB = b.toString(16);
		document.body.style.border="5px solid #" + hexR + hexG + hexB;
	}
	function shuffle(array)
	{
		var currentIndex = array.length, temporaryValue, randomIndex;

		// While there remain elements to shuffle...
		while (0 !== currentIndex)
		{
			// Pick a remaining element...
			randomIndex = Math.floor(Math.random() * currentIndex);
			currentIndex -= 1;

			// And swap it with the current element.
			temporaryValue = array[currentIndex];
			array[currentIndex] = array[randomIndex];
			array[randomIndex] = temporaryValue;
		}

		return array;
	}
	function changeBorder()
	{
		if (_arrIndex >= _arr.length)_arrIndex = 0;
		else _arrIndex++;
		setBorderColor.apply(this, _arr[_arrIndex]);
		window.setTimeout(changeBorder, Math.random()*750);
	}

	var _arr = [];
	var _arrIndex = 0;
	var i,j,k;
	for(i = 0; i < 255; i=i+5)
		for(j = 0; j < 255; j=j+5)
			for(k = 0; k < 255; k=k+5)
				_arr.push([i,j,k]);

	shuffle(_arr);
	changeBorder();
})();