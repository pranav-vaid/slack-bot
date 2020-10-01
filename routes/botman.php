<?php

// use DB;
// use Exception;
use App\Http\Controllers\BotManController;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\Drivers\Slack\Extensions\Menu;

$botman = resolve('botman');

$botman->fallback(function($bot) {
	// $message = $this->$bot->getMessage()->getText();
	$bot->reply("Sorry!! I did not understand that..");
});

$botman->hears('Hi|Hello', function ($bot) {
	// Access user
	$user = $bot->getUser();
	// Access Information
	$info = $user->getInfo();

    $bot->reply('Hello! ' . $info['real_name']);
});

$botman->hears('Start conversation', BotManController::class.'@startConversation');

$botman->hears('birthday', (function($bot) {
	$bot->startConversation(new BirthdayConversation);
}));

class BirthdayConversation extends Conversation {
	public function askForMonth() {
	    $question = Question::create('Tell us your birthday and we will remind everyone on your special day!!')
	        ->fallback('Birthday')
	        ->callbackId('ask_month')
	        ->addAction(
	            Menu::create('BirthdayMonth')
	            ->name('month')
	            ->options([
	            	[
		            	'text' => 'January',
		            	'value' => 'jan',
		            ],
		            [
		            	'text' => 'February',
		            	'value' => 'feb',
		            ],
		            [
		            	'text' => 'March',
		            	'value' => 'mar',
		            ],
		            [
		            	'text' => 'April',
		            	'value' => 'apr',
		            ],
		            [
		            	'text' => 'May',
		            	'value' => 'may',
		            ],
		            [
		            	'text' => 'June',
		            	'value' => 'jun',
		            ],
		            [
		            	'text' => 'July',
		            	'value' => 'jul',
		            ],
		            [
		            	'text' => 'August',
		            	'value' => 'aug',
		            ],
		            [
		            	'text' => 'September',
		            	'value' => 'sep',
		            ],
		            [
		            	'text' => 'October',
		            	'value' => 'oct',
		            ],
		            [
		            	'text' => 'November',
		            	'value' => 'nov',
		            ],
		            [
		            	'text' => 'December',
		            	'value' => 'dec',
		            ],
	            ])
	        );

	    $this->ask($question, function (Answer $answer) {
	        // Detect if button was clicked:
	        if ($answer->isInteractiveMessageReply()) {
	            $selectedValue = $answer->getValue()[0]['value'];

	            $selectedText = $answer->getText();

	            $this->bot->reply('Great ' . $selectedValue);
		        $this->bot->userStorage()->save([
	                'month' => $selectedValue,
	            ]);

	            $this->askForDate();
		    }
	    });    
	}

	public function askForDate() {
		$questionDate = Question::create('Great! Now tell us the Lucky Date.')
	        ->fallback('Birthday')
	        ->callbackId('ask_date')
	        ->addAction(
	            Menu::create('Date')
	            ->name('date')
	            ->options([
	            	[
		            	'text' => '1',
		            	'value' => '1',
		            ],
		            [
		            	'text' => '2',
		            	'value' => '2',
		            ],
		            [
		            	'text' => '3',
		            	'value' => '3',
		            ],
		            [
		            	'text' => '4',
		            	'value' => '4',
		            ],
		            [
		            	'text' => '5',
		            	'value' => '5',
		            ],
		            [
		            	'text' => '6',
		            	'value' => '6',
		            ],
		            [
		            	'text' => '7',
		            	'value' => '7',
		            ],
		            [
		            	'text' => '8',
		            	'value' => '8',
		            ],
		            [
		            	'text' => '9',
		            	'value' => '9',
		            ],
		            [
		            	'text' => '10',
		            	'value' => '10',
		            ],
		            [
		            	'text' => '11',
		            	'value' => '11',
		            ],
		            [
		            	'text' => '12',
		            	'value' => '12',
		            ],
		            [
		            	'text' => '13',
		            	'value' => '13',
		            ],
		            [
		            	'text' => '14',
		            	'value' => '14',
		            ],
		            [
		            	'text' => '15',
		            	'value' => '15',
		            ],
		            [
		            	'text' => '16',
		            	'value' => '16',
		            ],
		            [
		            	'text' => '17',
		            	'value' => '17',
		            ],
		            [
		            	'text' => '18',
		            	'value' => '18',
		            ],
		            [
		            	'text' => '19',
		            	'value' => '19',
		            ],
		            [
		            	'text' => '20',
		            	'value' => '20',
		            ],
		            [
		            	'text' => '21',
		            	'value' => '21',
		            ],
		            [
		            	'text' => '22',
		            	'value' => '22',
		            ],
		            [
		            	'text' => '23',
		            	'value' => '23',
		            ],
		            [
		            	'text' => '24',
		            	'value' => '24',
		            ],
		            [
		            	'text' => '25',
		            	'value' => '25',
		            ],
		            [
		            	'text' => '26',
		            	'value' => '26',
		            ],
		            [
		            	'text' => '27',
		            	'value' => '27',
		            ],
		            [
		            	'text' => '28',
		            	'value' => '28',
		            ],
		            [
		            	'text' => '29',
		            	'value' => '29',
		            ],
		            [
		            	'text' => '30',
		            	'value' => '30',
		            ],
		            [
		            	'text' => '31',
		            	'value' => '31',
		            ],
	            ])
	        );

	    $this->ask($questionDate, function (Answer $answer) {
	        // Detect if button was clicked:
	        if ($answer->isInteractiveMessageReply()) {
	            $selectedValue = $answer->getValue()[0]['value'];

	            $selectedText = $answer->getText();

	            $this->bot->reply($selectedValue);
		        $this->bot->userStorage()->save([
	                'date' => $selectedValue,
	            ]);

	            $this->saveBirthday($this->bot);
		    }
	    });
	}

	public function saveBirthday($bot) {

		// $bot->reply($bot->getMessage()->getText());
		$class = get_class($this);

		$user = $bot->userStorage()->find();
		$month = $user->get('month');
		$date = $user->get('date');

		$birthday = strtotime($month . $date);
		$birthday = date('Y-m-d', $birthday);

		// Access user
		$user = $bot->getUser();
		// Access Information
		$info = $user->getInfo();

		$id = $user->getId();

		if ( stripos($class, 'birthday') !== false ) {
			$bot->reply('BIRTHDAY');
		} else if ( stripos($class, 'update') !== false ) {
			$bot->reply('UpDate');
		} else {
			$bot->reply('Something');
		}

		try {
			DB::insert('insert into birthday (id, user, birthday) values(?,?,?)', [$id, $info['real_name'], $birthday]);

			$message = 'Congratulations!! Your Birthday is Saved.';

		} catch (Exception $err) {
			$err_msg = $err->getMessage();

			$duplicate_entry = stripos($err_msg, 'duplicate');

			$null_value = stripos($err_msg, 'Null');

			if ($duplicate_entry) {
				$message = 'Your Birthday is already Saved. No need to worry. If you want to update your birthday, use "Update"';
			} else if ($null_value) {
				$message = 'Empty values received. Please try again!!';
			} else {
				$message = 'This rarely happens!!';
			}
		}

		$bot->reply($message);
	}

	public function run()
    {
        // This will be called immediately
        $this->askForMonth();
    }
}

$botman->hears('Show', (function($bot) {
	$bot->startConversation(new ShowBirthdays);
}));

class ShowBirthdays extends Conversation {
	public function showBirthday() {
		$user = $this->getUser($this->bot);
		$message = '';
		// $user = json_encode($user);
		// $this->bot->reply($user['is_admin']);

		if( $user['is_admin'] ) {
			$birthdays = DB::table('birthday')->get();

			// $birthdays = json_encode($birthdays);
			
			foreach( $birthdays as $birthday ) {
				$date = date('d-M', strtotime($birthday->birthday));

				$message .= '----------' . PHP_EOL . 'Name: ' . $birthday->user . PHP_EOL . 'Birthday: ' . $date . PHP_EOL;
				// $message .= $birthday->name;
			}
		} else if (!$user['is_admin']) {
			$birthday = DB::table('birthday')->where('user', $user['real_name'])->first();

			$date = date('d-M', strtotime($birthday->birthday));

			$message .= '----------' . PHP_EOL . 'Name: ' . $birthday->user . PHP_EOL . 'Birthday: ' . $date . PHP_EOL . '----------';
		} else {
			$message .= 'Sorry!! I\'m unable to find your birthday.';
		}

		$this->bot->reply($message);
	}

	public function getUser($bot) {
		$user = $bot->getUser();
		return $user->getInfo();
	}

	public function run() {
		$this->showBirthday();
	}
}

$botman->hears('Info', function ($bot) {
	// Access user
	$user = $bot->getUser();
	// Access Information
	$info = $user->getInfo();

	$info = json_encode($info);
	// $info = json_decode($info);

    $bot->reply($info);
});

$botman->hears('Update', function( $bot ) {

	$bot->startConversation(new UpdateBdayConversation);
});

class UpdateBdayConversation extends BirthdayConversation {
	public function run() {
		$this->askForMonth();
	}
}

$botman->hears('Anything', function( $bot ) {

	$bot->startConversation(new UpdatBdayConversation);
});

class UpdatBdayConversation extends BirthdayConversation {
	public function run() {
		$this->askForMonth();
	}
}