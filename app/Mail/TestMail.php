<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;

    public $body;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($body) // конструктор нужен для того чтобы при создании экземпляра данного класса(для отправки письма) мы могли что-то в него передать которые можно будет использовать в представлениях
    {
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('test2')->attach(url('resources/front/img/1.jpg')); // тут у нас шаблон который мы будем видеть при получении email; attach() - нужен, для того чтобы прикрепить какой-то файл к письму
    }
    //
}
