<section class="novel-comments-form">
    <h2>Le début de ce roman vous plait ? Laissez-moi un commentaire !</h2>
    
    <form action="{{ route('addComment') }}" method="post">
        <input type="hidden" name="novel_id" value="{{$roman->alias}}">
        <div class="novel-form-group">
            <label for="pseudo">Votre pseudo</label>
            <input name="pseudo" id="pseudo" type="text">
        </div>
        <div class="novel-form-group">
            <label for="content">Commentaire</label>
            <textarea name="content" id="content"></textarea>
        </div>
        <button class="bouton">Envoyer</button>
    </form>
</section>