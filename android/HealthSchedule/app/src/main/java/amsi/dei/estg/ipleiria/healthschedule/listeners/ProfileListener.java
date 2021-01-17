package amsi.dei.estg.ipleiria.healthschedule.listeners;

import java.util.ArrayList;

import amsi.dei.estg.ipleiria.healthschedule.model.Marcacao;
import amsi.dei.estg.ipleiria.healthschedule.model.Profile;

public interface ProfileListener {

    void onRefreshListaProfiles(ArrayList<Profile> profiles);

    void onRefreshdetalhesProfiles();
}
