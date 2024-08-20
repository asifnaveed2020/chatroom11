<div>
   <h1>Welcome to chatbox </h1>

   <div>
      <h1>Messages</h1>
      <ul>
         @foreach ($messages as $msg)
          <li> {{$msg->message}}</li>
       @endforeach
      </ul>
   </div>
   <form wire:submit.prevent="save">
      <input id="message" name="message" wire:model="message" value="" />
      <button type="submit">Fetch and Save Data</button>
   </form>
</div>