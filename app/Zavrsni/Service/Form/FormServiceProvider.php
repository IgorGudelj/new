<?php namespace Zavrsni\Service\Form;

use Illuminate\Support\ServiceProvider;
use Zavrsni\Service\Form\Login\LoginForm;
use Zavrsni\Service\Form\Login\LoginFormLaravelValidator;
use Zavrsni\Service\Form\Register\RegisterForm;
use Zavrsni\Service\Form\Register\RegisterFormLaravelValidator;
use Zavrsni\Service\Form\Group\GroupForm;
use Zavrsni\Service\Form\Group\GroupFormLaravelValidator;
use Zavrsni\Service\Form\User\UserForm;
use Zavrsni\Service\Form\User\UserFormLaravelValidator;
use Zavrsni\Service\Form\ResendActivation\ResendActivationForm;
use Zavrsni\Service\Form\ResendActivation\ResendActivationFormLaravelValidator;
use Zavrsni\Service\Form\ForgotPassword\ForgotPasswordForm;
use Zavrsni\Service\Form\ForgotPassword\ForgotPasswordFormLaravelValidator;
use Zavrsni\Service\Form\ChangePassword\ChangePasswordForm;
use Zavrsni\Service\Form\ChangePassword\ChangePasswordFormLaravelValidator;
use Zavrsni\Service\Form\SuspendUser\SuspendUserForm;
use Zavrsni\Service\Form\SuspendUser\SuspendUserFormLaravelValidator;

class FormServiceProvider extends ServiceProvider {

    /**
     * Register the binding
     *
     * @return void
     */
    public function register()
    {
        $app = $this->app;

        // Bind the Login Form
        $app->bind('Zavrsni\Service\Form\Login\LoginForm', function($app)
        {
            return new LoginForm(
                new LoginFormLaravelValidator( $app['validator'] ),
                $app->make('Zavrsni\Repo\Session\SessionInterface')
            );
        });

        // Bind the Register Form
        $app->bind('Zavrsni\Service\Form\Register\RegisterForm', function($app)
        {
            return new RegisterForm(
                new RegisterFormLaravelValidator( $app['validator'] ),
                $app->make('Zavrsni\Repo\User\UserInterface')
            );
        });

        // Bind the Group Form
        $app->bind('Zavrsni\Service\Form\Group\GroupForm', function($app)
        {
            return new GroupForm(
                new GroupFormLaravelValidator( $app['validator'] ),
                $app->make('Zavrsni\Repo\Group\GroupInterface')
            );
        });

        // Bind the User Form
        $app->bind('Zavrsni\Service\Form\User\UserForm', function($app)
        {
            return new UserForm(
                new UserFormLaravelValidator( $app['validator'] ),
                $app->make('Zavrsni\Repo\User\UserInterface')
            );
        });

        // Bind the Resend Activation Form
        $app->bind('Zavrsni\Service\Form\ResendActivation\ResendActivationForm', function($app)
        {
            return new ResendActivationForm(
                new ResendActivationFormLaravelValidator( $app['validator'] ),
                $app->make('Zavrsni\Repo\User\UserInterface')
            );
        });

        // Bind the Forgot Password Form
        $app->bind('Zavrsni\Service\Form\ForgotPassword\ForgotPasswordForm', function($app)
        {
            return new ForgotPasswordForm(
                new ForgotPasswordFormLaravelValidator( $app['validator'] ),
                $app->make('Zavrsni\Repo\User\UserInterface')
            );
        });

        // Bind the Change Password Form
        $app->bind('Zavrsni\Service\Form\ChangePassword\ChangePasswordForm', function($app)
        {
            return new ChangePasswordForm(
                new ChangePasswordFormLaravelValidator( $app['validator'] ),
                $app->make('Zavrsni\Repo\User\UserInterface')
            );
        });

        // Bind the Suspend User Form
        $app->bind('Zavrsni\Service\Form\SuspendUser\SuspendUserForm', function($app)
        {
            return new SuspendUserForm(
                new SuspendUserFormLaravelValidator( $app['validator'] ),
                $app->make('Zavrsni\Repo\User\UserInterface')
            );
        });

    }

}