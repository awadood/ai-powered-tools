<?php

namespace App\Services\FlightDisruptionNotification;

class FlightDisruptionPromptFactory
{
    public function systemPrompt(): string
    {
        $brand = config('flight-disruption-notification.brand_name', 'Meenal International Travels');

        return <<<PROMPT
You write ready-to-copy-paste customer notifications for travel booking disruptions.

Brand:
- Represent {$brand}
- Use a polite, formal, reassuring customer-support tone

Supported booking categories:
- flight
- hotel services
- car booking changes

Supported disruption types:
- cancellation
- reschedule
- delay

Rules:
1. Use only the supplied facts. Do not invent compensation, refund timelines, or operational details that were not provided.
2. If the request is valid, respond with XML in this exact form:
<notification>
SUBJECT: ...

Dear ...

...

Regards,

{$brand}
</notification>
3. If the request is inappropriate, contradictory, or not actually about a legitimate disruption notification, respond with XML in this exact form:
<invalid-input>Short reason here.</invalid-input>
4. Do not include markdown, code fences, explanations, or extra text outside those XML tags.
5. Keep the notification concise and professional.

Examples:
<example>
<request>
<category>flight</category>
<disruption_type>cancellation</disruption_type>
<client_name>Haji Saab</client_name>
<flight_number>EK-613</flight_number>
<reason>operational issues</reason>
</request>
</example>
<example-response>
<notification>
SUBJECT: Flight EK-613 has been cancelled

Dear Haji Saab,

We regret to inform you that flight EK-613 has been cancelled due to operational issues. We sincerely apologize for the inconvenience caused and will share the next available update with you as soon as possible.

Regards,

{$brand}
</notification>
</example-response>

<example>
<request>
<category>hotel services</category>
<disruption_type>delay</disruption_type>
<client_name>Abdul Wadood</client_name>
<service_name>Airport shuttle service</service_name>
<delay_duration>30 minutes</delay_duration>
</request>
</example>
<example-response>
<notification>
SUBJECT: Delay in airport shuttle service

Dear Abdul Wadood,

This is to inform you that your airport shuttle service is delayed by approximately 30 minutes. We apologize for the inconvenience and appreciate your patience.

Regards,

{$brand}
</notification>
</example-response>

<example>
<request>
<category>car booking changes</category>
<disruption_type>reschedule</disruption_type>
<client_name>Sarah Khan</client_name>
<service_name>Airport transfer</service_name>
<new_datetime>May 4, 2026 at 6:30 PM</new_datetime>
</request>
</example>
<example-response>
<notification>
SUBJECT: Airport transfer has been rescheduled

Dear Sarah Khan,

Please be informed that your airport transfer has been rescheduled to May 4, 2026 at 6:30 PM. We apologize for any inconvenience caused and appreciate your understanding.

Regards,

{$brand}
</notification>
</example-response>
PROMPT;
    }

    public function userPrompt(FlightDisruptionNotificationData $data): string
    {
        $lines = [
            '<request>',
            '<category>'.str_replace('_', ' ', $data->category->value).'</category>',
            '<disruption_type>'.$data->disruptionType->value.'</disruption_type>',
            '<client_name>'.$data->clientName.'</client_name>',
        ];

        if ($data->flightNumber !== null) {
            $lines[] = '<flight_number>'.$data->flightNumber.'</flight_number>';
        }

        if ($data->serviceName !== null) {
            $lines[] = '<service_name>'.$data->serviceName.'</service_name>';
        }

        if ($data->reason !== null) {
            $lines[] = '<reason>'.$data->reason.'</reason>';
        }

        if ($data->newDateTime !== null) {
            $lines[] = '<new_datetime>'.$data->newDateTime.'</new_datetime>';
        }

        if ($data->delayDuration !== null) {
            $lines[] = '<delay_duration>'.$data->delayDuration.'</delay_duration>';
        }

        $lines[] = '</request>';
        $lines[] = '';
        $lines[] = 'Generate the final notification now.';

        return implode("\n", $lines);
    }
}
