<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Candidate
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property mixed|null $image
 * @property int $election_id
 * @property int $votes
 * @property string $uuid
 * @property string $type
 * @property int $level
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereElectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereVotes($value)
 * @mixin \Eloquent
 */
	class Candidate extends \Eloquent {}
}

namespace App{
/**
 * App\Election
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int|null $abstention
 * @property string $status
 * @property string $uuid
 * @property string $type
 * @property int|null $permission_id
 * @property string|null $activeby
 * @property string|null $activeto
 * @property mixed|null $logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Candidate[] $candidates
 * @property-read int|null $candidates_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Terminal[] $terminals
 * @property-read int|null $terminals_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Voter[] $voters
 * @property-read int|null $voters_count
 * @method static \Illuminate\Database\Eloquent\Builder|Election newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Election newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Election query()
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereAbstention($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereActiveby($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereActiveto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election wherePermissionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Election whereUuid($value)
 * @mixin \Eloquent
 */
	class Election extends \Eloquent {}
}

namespace App{
/**
 * App\Form
 *
 * @property int $id
 * @property string $name
 * @property int $election_id
 * @property string $uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Schoolclass[] $schoolclasses
 * @property-read int|null $schoolclasses_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Voter[] $voters
 * @property-read int|null $voters_count
 * @method static \Illuminate\Database\Eloquent\Builder|Form newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Form newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Form query()
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereElectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Form whereUuid($value)
 * @mixin \Eloquent
 */
	class Form extends \Eloquent {}
}

namespace App{
/**
 * App\FourthSafety
 *
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FourthSafety query()
 * @mixin \Eloquent
 */
	class FourthSafety extends \Eloquent {}
}

namespace App{
/**
 * App\Schoolclass
 *
 * @property int $id
 * @property string $name
 * @property int $election_id
 * @property int $form_id
 * @property string $uuid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass query()
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereElectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Schoolclass whereUuid($value)
 * @mixin \Eloquent
 */
	class Schoolclass extends \Eloquent {}
}

namespace App{
/**
 * App\Terminal
 *
 * @property int $id
 * @property string $name
 * @property string $kind
 * @property string $description
 * @property string $position
 * @property string $status
 * @property string|null $start_time
 * @property string|null $end_time
 * @property string|null $ip_restriction
 * @property string $uuid
 * @property int $election_id
 * @property int|null $hits
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal query()
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereElectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereHits($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereIpRestriction($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereKind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal wherePosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Terminal whereUuid($value)
 * @mixin \Eloquent
 */
	class Terminal extends \Eloquent {}
}

namespace App{
/**
 * App\ThirdSafety
 *
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdSafety newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdSafety newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ThirdSafety query()
 * @mixin \Eloquent
 */
	class ThirdSafety extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $surname
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $location
 * @property string|null $city
 * @property string|null $institution
 * @property int $approved
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Permission[] $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Spatie\Permission\Models\Role[] $roles
 * @property-read int|null $roles_count
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User permission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User role($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereApproved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereInstitution($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

namespace App{
/**
 * App\Voter
 *
 * @property int $id
 * @property string|null $surname
 * @property string|null $name
 * @property string|null $birth_year
 * @property int $voted_via_email
 * @property int $voted_via_terminal
 * @property int $got_email
 * @property string $uuid
 * @property string $direct_uuid
 * @property string|null $direct_token
 * @property string|null $email
 * @property int $election_id
 * @property int|null $schoolclass_id
 * @property int|null $form_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Schoolclass|null $schoolclass
 * @method static \Illuminate\Database\Eloquent\Builder|Voter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Voter query()
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereBirthYear($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereDirectToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereDirectUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereElectionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereFormId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereGotEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereSchoolclassId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereUuid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereVotedViaEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Voter whereVotedViaTerminal($value)
 * @mixin \Eloquent
 */
	class Voter extends \Eloquent {}
}

