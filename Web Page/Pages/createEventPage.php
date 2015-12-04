<!DOCTYPE html>
<html>

<head>
    <title>jQuery Dialog Form Example</title>
	
    <script src="../Client/jquery-1.11.3.min.js"></script>
    <link href="../Styles/dialog.css" rel="stylesheet" type="text/css" media="all" />
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
    <script src="../Client/dialog.js" type="text/javascript"></script>
</head>

<body>
    <div class="container">
        <div class="main">
            <div id="dialog">
			<h1>Create new Event:</h1>
			<!-- Imagem do evento -->
                <form action="" method="post">
				<div id="upload">
					<input type="file" name="fileToUpload" id="fileToUpload">
				</div>
					<table>
						<tr><td>Name</td> <td><input id="name" name="name" type="text"></td></tr>
						<tr><td>Type</td>
						<td><select>
							<option value="Birthday">Birthday</option>
							<option value="Concert">Concert</option>
							<option value="Sports">Sports</option>
							<option value="Meeting">Meeting</option>
							<option value="Wedding">Wedding</option>
							<option value="Party">Party</option>
							<option value="Conference">Conference</option>
							<option value="Misc Event">Misc Event</option>
						</select></td></tr>
						<tr><td>Location</td> <td><input id="name" name="name" type="text"></td></tr>
						<tr><td>Descrição</td> <td><textarea rows="10%" cols="20%" name="comment"></textarea></td></tr>
						<tr><td>Date</td> <td><input type="date" name="eventdate"></tr>
						<tr><td>Private</td> <td><input type="checkbox" name="private" value=""></tr>
						<!--<tr>data</tr>
						<tr>imagem</tr>
						<tr>privado</tr> -->
					</table>
                    <input id="submit" type="submit" value="Submit">
                </form>
            </div>
            <h2>jQuery Dialog Form Example</h2>
            <p>Click below button to see jQuery dialog form.</p>
            <input id="button" type="button" value="Open Dialog Form">
        </div>
    </div>

</body>

</html>