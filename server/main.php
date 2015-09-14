<?php

require 'inc/WebSocketUser.class.php';
require 'inc/WebSocketServer.class.php';

class boomServer extends WebSocketServer
{
    /**
     * Maximum buffer size (inherited)
     * @var integer
     */
    protected $maxBufferSize = 1048576; //1MB... overkill for an echo server, but potentially plausible for other applications.

	public $sessions = array();

	public $session_sockets = array();

	public $users = array();

    public function startSession($time, $owner)
    {
    	$id = uniqid();

    	$this->session[$id][0] = $time;
    	$this->session[$id][1] = $owner;

    	$this->session_sockets[$id] = $owner;
    }

    public function findSessionBySocket($socket)
    {
    	if ( ($return = array_search($socket, $this->session_sockets)) === true )
    		return $return;
    	else
    		return false;
    }

	public function findSessionByID($id)
	{
    	if ( ($return = array_search($id, array_keys($this->session_sockets))) === true )
    		return $return;
    	else
    		return false;
	}

	public function sendToUser($user, $message)
	{
		if ( $user->messageType == " " )
		{

		}
	}

	public function decrypt($text, $salt)
	{

	}

    /**
     * Process incoming messages (inherited)
     * @param  userClass $user    userClass instance of the user that sent the message
     * @param  string    $message Message the user sent
     * @return null
     */
    protected function process($user, $message) 
    {
    	switch ( $message )
    	{

    	}
    }

    /**
     * Handle new user connections (inherited)
     * @param  userClass $user userClass instance of the user that is connected
     * @return null
     */
    protected function connected($user) 
    {
    	if ( $this->findSessionBySocket($user->socket) !== FALSE )
    	{
    		$this->sendToUser($user, 'ALREADY_ON_SESSION');
    	}
    	else
    	{
    		$this->sendToUser($user, 'WAITING_FOR_ASSIGN');

    		$this->users[$user->id]['ip'] = $user->getIP();
    		$this->users[$user->id]['sock'] = $user->socket;
    	}
    }

    /**
     * Handle user disconnection (inherited)
     * @param  userClass $user userClass instance of the disconnected user
     * @return null
     */
    protected function closed($user) 
    {
    	if ( $this->findSessionBySocket($user->socket) !== FALSE )
    	{
    		
    	}
    }
}