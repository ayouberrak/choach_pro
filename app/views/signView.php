<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../public/css/signUp.css">
    <script src="../../public/js/formSignup.js" defer></script>
</head>
<body>
    <h1>s'inscire</h1>
    <form action="" method="post">
        <label for="nom">le nom </label><br>
        <input type="text" name="nom"><br>
        <label for="prenom">le prenom </label><br>
        <input type="text" name="prenom"><br>
        <label for="email">email </label><br>
        <input type="text" name="email"><br>
        <label for="password">password </label><br>
        <input type="password" name="password"><br>
        <label for="role">le role </label><br>
        <select name="role" id="roleSelect">
            <option selected disabled>le roles</option>
            <?php foreach($roleSelect AS $role){ ?>
                <option value="<?= $role['id_role']?>"><?= $role['type_role']?></option>
            <?php } ?>
        </select><br>
        <div id="divCoach">
            <label for="biographie">biographie</label><br>
            <textarea name="biographie" id=""></textarea><br>
            <label for="photo">photo</label><br>
            <input type="file" name="photo"><br>
            <label for="annes_exepriances">annes_exepriances</label><br>
            <input type="number" name="annes_exepriances"><br>
            <label for="certification">certification</label><br>
            <input type="text" name="certification"><br>
        </div>
        <div id="divClient">
            <label for="tel">le numero de telephone </label><br>
            <input type="number" name="tel"><br>
        </div>
        <button type="submit">s'sincrire</button>
    </form>
</body>
</html>