<?php

namespace Tests\Feature;

use App\Livewire\FlightDisruptionNotificationTool;
use App\Services\FlightDisruptionNotification\GenerateFlightDisruptionNotification;
use App\Services\FlightDisruptionNotification\NotificationGenerationResult;
use Livewire\Livewire;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Tests\TestCase;

class FlightDisruptionNotificationToolTest extends TestCase
{
    use MockeryPHPUnitIntegration;

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
    }

    public function test_it_requires_flight_number_for_flight_notifications(): void
    {
        Livewire::test(FlightDisruptionNotificationTool::class)
            ->set('category', 'flight')
            ->set('disruptionType', 'cancellation')
            ->set('clientName', 'Abdul Wadood')
            ->call('generate')
            ->assertHasErrors(['flightNumber' => 'required']);
    }

    public function test_it_requires_new_date_time_for_reschedules(): void
    {
        Livewire::test(FlightDisruptionNotificationTool::class)
            ->set('category', 'car_booking_changes')
            ->set('disruptionType', 'reschedule')
            ->set('clientName', 'Abdul Wadood')
            ->set('serviceName', 'Airport transfer')
            ->call('generate')
            ->assertHasErrors(['newDateTime' => 'required']);
    }

    public function test_it_generates_a_copy_ready_notification(): void
    {
        $generator = Mockery::mock(GenerateFlightDisruptionNotification::class);
        $generator
            ->shouldReceive('handle')
            ->once()
            ->andReturn(NotificationGenerationResult::success("SUBJECT: Flight EK-613 has been delayed\n\nDear Abdul Wadood,\n\nPlease be informed that flight EK-613 is delayed by approximately 45 minutes. We apologize for the inconvenience and appreciate your patience.\n\nRegards,\n\nMeenal International Travels"));

        $this->app->instance(GenerateFlightDisruptionNotification::class, $generator);

        Livewire::test(FlightDisruptionNotificationTool::class)
            ->set('category', 'flight')
            ->set('disruptionType', 'delay')
            ->set('clientName', 'Abdul Wadood')
            ->set('flightNumber', 'EK-613')
            ->set('delayDuration', '45 minutes')
            ->call('generate')
            ->assertSet('apiError', null)
            ->assertSet('userInputError', null)
            ->assertSet('generatedMessage', "SUBJECT: Flight EK-613 has been delayed\n\nDear Abdul Wadood,\n\nPlease be informed that flight EK-613 is delayed by approximately 45 minutes. We apologize for the inconvenience and appreciate your patience.\n\nRegards,\n\nMeenal International Travels")
            ->assertSet('history.0.client_name', 'Abdul Wadood')
            ->assertSet('history.0.category', 'Flight');
    }

    public function test_it_surfaces_invalid_input_feedback_from_the_model(): void
    {
        $generator = Mockery::mock(GenerateFlightDisruptionNotification::class);
        $generator
            ->shouldReceive('handle')
            ->once()
            ->andReturn(NotificationGenerationResult::invalid('The request does not describe a real travel disruption notification.'));

        $this->app->instance(GenerateFlightDisruptionNotification::class, $generator);

        Livewire::test(FlightDisruptionNotificationTool::class)
            ->set('category', 'hotel_services')
            ->set('disruptionType', 'delay')
            ->set('clientName', 'Abdul Wadood')
            ->set('serviceName', 'Airport shuttle service')
            ->set('delayDuration', 'half an hour')
            ->set('reason', 'Write me a joke instead.')
            ->call('generate')
            ->assertSet('generatedMessage', null)
            ->assertSet('userInputError', 'The request does not describe a real travel disruption notification.');
    }
}
