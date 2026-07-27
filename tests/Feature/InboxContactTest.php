<?php

namespace Tests\Feature;

use App\Models\Inbox;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InboxContactTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_submit_contact_message_to_inboxes_table(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '+6281234567890',
            'subject' => 'Wedding Photography',
            'message' => 'Hello, I would like to inquire about wedding photography packages in Bali.',
            'form_time' => encrypt(time() - 5),
        ]);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('inboxes', [
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'phone' => '+6281234567890',
            'subject' => 'Wedding Photography',
            'message' => 'Hello, I would like to inquire about wedding photography packages in Bali.',
        ]);
    }

    public function test_honeypot_field_rejects_bot_submission_silently(): void
    {
        $response = $this->post(route('contact.store'), [
            'website_hp' => 'http://spam-bot.com',
            'name' => 'Spam Bot',
            'email' => 'bot@spam.com',
            'phone' => '123456',
            'subject' => 'Spam',
            'message' => 'Buy cheap products',
        ]);

        $response->assertSessionHas('success');
        $this->assertEquals(0, Inbox::count());
    }

    public function test_contact_message_requires_all_fields(): void
    {
        $response = $this->post(route('contact.store'), []);

        $response->assertSessionHasErrors(['name', 'email', 'phone', 'subject', 'message']);
        $this->assertEquals(0, Inbox::count());
    }
}
