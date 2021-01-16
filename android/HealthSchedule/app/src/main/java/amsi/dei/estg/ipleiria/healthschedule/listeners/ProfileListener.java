package amsi.dei.estg.ipleiria.healthschedule.listeners;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.model.Profile;

public interface ProfileListener {

    void onRefreshListaProfile(ArrayList<Profile> profiles);

    void onRefreshdetalhesProfiles();

}
